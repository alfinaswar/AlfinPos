<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'produks';
    protected $guarded = ['id'];

    public function getKategori()
    {
        return $this->belongsTo(KategoriItem::class, 'KategoriItem', 'id');
    }

    public function getJenis()
    {
        return $this->belongsTo(JenisItem::class, 'JenisItem', 'id');
    }
    public function getPenjualan()
    {
        return $this->hasMany(TransaksiDetail::class, 'IdProduk', 'id');
    }
}
