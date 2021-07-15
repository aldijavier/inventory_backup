<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Masuk extends Model
{
    protected $table = 'product_masuk';

    protected $fillable = ['nomor_form', 'nomor_asset', 'pic','jenis_kategori','nama_kategori',
    'product_id','tanggal_terima','lokasi_terima','po', 'po_string', 'do','qty','serial_number','spesifikasi','remarks'];
    
    protected $hidden = ['created_at','updated_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
