<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes; // Untuk fitur soft delete

class Organization extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'organizations'; // Sesuai dengan nama tabel di migrasi

    protected $fillable = [
        'name',
        'slug',
        'deskripsi_organisasi',
        'url_logo',
        'alamat',
        'nomor_telepon',
        'email_organisasi',
        'website_organisasi',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
    ];


    protected $casts = [
        // Contoh: 'email_verified_at' => 'datetime',
        // Tidak ada kolom khusus yang memerlukan casting eksplisit di migrasi ini selain default
    ];

    public function datasets(): HasMany
    {
        return $this->hasMany(Dataset::class, 'id_organization', 'id');
    }


    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
