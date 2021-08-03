<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'category_id'          => $row['category_id'],
            'jenis_id'        => $row['jenis_id'],
            'nama'         => $row['nama'],
            'qty'       => $row['qty']
        ]);
    }
}
