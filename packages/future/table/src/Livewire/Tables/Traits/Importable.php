<?php

namespace Future\Table\Livewire\Tables\Traits;

use Future\Core\Http\Exports\DataExport;
use Future\Core\Http\Imports\DataImport;
use Maatwebsite\Excel\Facades\Excel;


trait Importable
{
    public $importFile;
    /**
     * Import data from Excel.
     *

     */
    public function importExcel()
    {
        $this->validate([
            'importFile' => 'required|mimes:xlsx,xls,csv'
        ]);
        $filePath = $this->importFile->store('temp');

        $import = new DataImport;
        Excel::import($import, $filePath);
        $products = $import->getData();
        $newProducts = [];
        foreach ($products as $product) {
            if ($product['product_description'] != null){
                $value = explode(';', $product['product_description'])[1];
                $value = explode('#&', $value);
                if (!empty($value[1])){
                    //lưu lại dữ liệu product_description vào lại product
                    $product['product_description'] = $value[1];
                    $newProducts[] = $product;
                }
            }
        }
        return Excel::download(new DataExport($newProducts), 'data.xlsx');
    }
}
