<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Keluar extends Model
{
    protected $table = 'product_keluar';

    protected $fillable = ['nomor_form', 'pic','jenis_kategori','nama_kategori',
    'product_id','tanggal_keluar','lokasi_pengambilan', 'lokasi_pemasangan', 'departement', 'departement_pic',
    'spk', 'pform', 'qty','serial_number','remarks'];

    protected $hidden = ['created_at','updated_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function pic()
    {
        return $this->belongsTo(UserDemand::class);
    }

    // public function customer()
    // {
    //     return $this->belongsTo(Customer::class);
    // }
}
