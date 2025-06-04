<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tentang extends Model
{
    protected $table = 'tentangs';
    protected $fillable = ['judul', 'deskripsi'];

    public function getJudulAttribute($value)
    {
        return $value;
    }

    public function getDeskripsiAttribute($value)
    {
        return $value;
    }
}
