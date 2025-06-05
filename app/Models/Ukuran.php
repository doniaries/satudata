<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ukuran extends Model
{

    protected $table = 'ukurans';

    protected $fillable = [
        'nama_ukuran',
    ];

    public function datasets()
    {
        return $this->belongsToMany(Dataset::class);
    }
}
