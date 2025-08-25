<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaksis';
    protected $guarded = ['id'];

    public function NamaKasir()
    {
        return $this->hasOne(User::class, 'id', 'IdKasir');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(TransaksiDetail::class, 'IdTransaksi', 'id');
    }
}
