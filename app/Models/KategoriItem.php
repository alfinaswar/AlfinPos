<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriItem extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'kategori_items';
    protected $guarded = ['id'];
}
