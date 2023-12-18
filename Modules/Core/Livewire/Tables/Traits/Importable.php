<?php

namespace Modules\Core\Livewire\Tables\Traits;

use Maatwebsite\Excel\Facades\Excel;
use Modules\Core\Http\Imports\DataImport;

trait Importable
{
    public $importFile;
    /**
     * Import data from Excel.
     *
     * @return array
     */
    public function importExcel()
    {
        $filePath = $this->importFile->store('temp');

        $import = new DataImport;
        Excel::import($import, $filePath);
        return $import->getData();
    }
}
