<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;


    protected $table = 'tags'; // Sesuai dengan nama tabel di migrasi


    protected $fillable = [
        'name', // Kolom dari migrasi
        'slug',       // Kolom dari migrasi
    ];


}
