<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes; // Untuk fitur soft delete

class Resource extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'resources'; // Sesuai dengan nama tabel di migrasi

    protected $fillable = [
        'id_dataset',
        'nama_berkas',
        'deskripsi_berkas',
        'url_berkas',
        'format_berkas',
        'ukuran_berkas',
        'terakhir_diubah_berkas',
        'jumlah_diunduh_berkas',
    ];

    protected $casts = [
        'terakhir_diubah_berkas' => 'datetime', // Kolom `terakhir_diubah_berkas` bertipe dateTime
        'ukuran_berkas' => 'integer', // Kolom `ukuran_berkas` bertipe unsignedBigInteger
        'jumlah_diunduh_berkas' => 'integer', // Kolom `jumlah_diunduh_berkas` bertipe unsignedInteger
    ];

    public function dataset(): BelongsTo
    {
        return $this->belongsTo(Dataset::class);
    }
}
