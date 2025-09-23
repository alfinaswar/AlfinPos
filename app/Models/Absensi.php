<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Absensi extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'absensis';
    protected $guarded = ['id'];

    public function getUser()
    {
        return $this->hasOne(User::class, 'id', 'UserCreate');
    }
    public function getShift()
    {
        return $this->hasOne(MasterShift::class, 'id', 'Shift');
    }

}
