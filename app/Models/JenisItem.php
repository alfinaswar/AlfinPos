<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisItem extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'jenis_items';
    protected $guarded = ['id'];
    public function KategoriItem()
    {
        return $this->belongsTo(KategoriItem::class, 'KategoriItem', 'id');
    }
}
