<?php

namespace Adminftr\Table\Future\Traits;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;
use packages\adminftr\core\src\Http\Exports\DataExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

trait Exportable
{
    public $type = 'excel';

    public function export()
    {
        if ($this->type == 'excel') {
            return $this->exportExcel();
        } elseif ($this->type == 'csv') {
            return $this->exportCsv();
        } elseif ($this->type == 'pdf') {
            return $this->exportPdf();
        }
    }

    /**
     * Export data to Excel.
     *
     * @return BinaryFileResponse
     */
    protected function exportExcel()
    {
        $data = $this->applyTableQuery()->paginate($this->perPage);
        $headings = array_map(function ($column) {
            return $column->label;
        }, $this->defineColumns());

        return Excel::download(new DataExport($data, $headings), 'data.xlsx');
    }

    /**
     * Export data to CSV.
     *
     * @return BinaryFileResponse
     */
    protected function exportCsv()
    {
        $data = $this->applyTableQuery()->get();
        $headings = array_map(function ($column) {
            return $column->label;
        }, $this->defineColumns());

        return Excel::download(new DataExport($data, $headings), 'data.csv');
    }

    /**
     * Export data to PDF.
     *
     * @return Response
     */
    protected function exportPdf()
    {
        $data = $this->applyTableQuery()->get();
        $headings = array_map(function ($column) {
            return $column->label;
        }, $this->defineColumns());
        $pdf = PDF::loadView('', compact('data', 'headings'));

        return $pdf->download('data.pdf');
    }
}
