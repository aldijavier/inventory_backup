<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDemand extends Model
{
    protected $fillable = ['nama_karyawan', 'dept'];
}
