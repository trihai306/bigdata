<?php

namespace Future\Table\Livewire\Tables\Traits;

use Future\Core\Http\Exports\DataExport;
use Future\Core\Http\Imports\DataImport;
use Illuminate\Support\Collection;
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
        $header = [];
        //lấy header theo key của mảng đầu tiên
        foreach ($products[0] as $key => $value){
            $header[] = $key;
        }
        foreach ($products as $product){

            if ($product['product_description'] != null){
                // đếm số lượng dấu ; trong product_description
                $count = substr_count($product['product_description'], ';');
                if ($count == 1){
                    $value = explode(';', $product['product_description']);
                    if (preg_match('/[áàảãạăắằẳẵặâấầẩẫậéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵđ]/i', $value[0])) {
                     $value = explode('#&', $value[0]);
                    }else{
                        $value = explode('#&', $value[1]);
                    }
                    if (!empty($value[1])){
                        //lưu lại dữ liệu product_description vào lại product
                        $product['product_description'] = $value[1];
                        $newProducts[] = $product;
                    }
                    else{
                        $product['product_description'] = $value[0];
                        $newProducts[] = $product;
                    }
                }elseif ($count >= 1){
                    $natural = ($count + 1) / 2;
                    $values = explode(';', $product['product_description'], $count);

                    if (preg_match('/[áàảãạăắằẳẵặâấầẩẫậéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵđ]/i', $values[0])) {
                        // Nối chuỗi từ vị trí 0 đến vị trí $natural
                        $value = implode(';', array_slice($values, 0, $natural));
                    } else {
                        // Nối chuỗi từ vị trí $natural đến vị trí cuối
                       $value = implode(';', array_slice($values, $natural));
                    }
                    //lấy string từ vị trí $natural đến vị trí cuối
                    $value = explode('#&', $value);
                    if (!empty($value[1])){
                        //lưu lại dữ liệu product_description vào lại product
                        $product['product_description'] = $value[1];
                        $newProducts[] = $product;
                    }
                }
            }
        }
        $newProducts = new Collection($newProducts);
        return Excel::download(new DataExport($newProducts,$header), 'data.xlsx');
    }
}
