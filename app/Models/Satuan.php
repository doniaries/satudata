<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = 'satuans';

    protected $fillable = [
        'nama_satuan',
    ];

    public function datasets()
    {
        return $this->hasMany(Dataset::class);
    }

    public function scopeWithRelations($query)
    {
        return $query->with(['datasets']);
    }
}
