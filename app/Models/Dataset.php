<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes; // Untuk fitur soft delete

class Dataset extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'datasets'; // Sesuai dengan nama tabel di migrasi



    protected $fillable = [
        'id_organisasi',
        'judul',
        'slug',
        'deskripsi_dataset',
        'satuan',
        'ukuran',
        'frekuensi_pembaruan',
        'dasar_rujukan_prioritas',
        'lisensi',
        'penulis_kontak',
        'email_penulis_kontak',
        'pemelihara_data',
        'email_pemelihara_data',
        'sumber_data',
        'tanggal_rilis',
        'tanggal_modifikasi_metadata',
        'is_publik',
        'metadata_tambahan',
        'url_kamus_data',
        'created_by_user_id',
        'updated_by_user_id',
    ];

    protected $casts = [
        'tanggal_rilis' => 'date', // Kolom `tanggal_rilis` bertipe date
        'tanggal_modifikasi_metadata' => 'date', // Kolom `tanggal_modifikasi_metadata` bertipe date
        'is_publik' => 'boolean', // Kolom `is_publik` bertipe boolean
        'metadata_tambahan' => 'array', // Kolom `metadata_tambahan` bertipe json
        'jumlah_dilihat' => 'integer', // Kolom `jumlah_dilihat` bertipe unsignedInteger

    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'id_organization', 'id');
    }

    public function resources(): HasMany
    {
        return $this->hasMany(Resource::class);
    }


    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }

    public function satuans()
    {
        return $this->belongsToMany(Satuan::class, 'satuans', 'dataset_id', 'satuan_id');
    }

    public function ukurans()
    {
        return $this->belongsToMany(Ukuran::class, 'ukurans', 'dataset_id', 'ukuran_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'dataset_tags');
    }

    public function scopeWithRelations($query)
    {
        return $query->with(['organization', 'tags', 'resources']);
    }
}
