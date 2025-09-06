<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KonversiItem extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'konversi_items';
    protected $guarded = ['id'];
    public function getProduk()
    {
        return $this->belongsTo(Produk::class, 'IdProduk', 'id');
    }
}
