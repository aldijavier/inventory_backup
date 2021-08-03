<?php

namespace App\Imports;

use App\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoriesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Category([
            'kode_barang'          => $row['kode_barang'],
            'name'        => $row['name'],
            'spek'         => $row['spek'],
            'brand'       => $row['brand'],
            'category'       => $row['category']
        ]);
    }
}
