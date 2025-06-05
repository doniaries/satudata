<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Organization;
use App\Models\Tag;
use App\Models\Resource;
use App\Models\Satuan;
use App\Models\Ukuran;
use App\Models\User;

class Dataset extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'datasets'; // Sesuai dengan nama tabel di migrasi



    protected $fillable = [
        'id_organization',
        'judul',
        'slug',
        'deskripsi_dataset',
        'satuan_id',
        'ukuran_id',
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
        'tanggal_rilis' => 'date',
        'tanggal_modifikasi_metadata' => 'date',
        'is_publik' => 'boolean',
        'metadata_tambahan' => 'array',
        'jumlah_dilihat' => 'integer',
    ];

    /**
     * Get the organization that owns the dataset.
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'id_organization', 'id');
    }

    /**
     * Get all resources for the dataset.
     */
    // public function resources(): HasMany
    // {
    //     return $this->hasMany(Resource::class);
    // }

    /**
     * Get the user who created the dataset.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    /**
     * Get the user who last updated the dataset.
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }

    /**
     * Get the satuan for the dataset.
     */
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }

    /**
     * Get the ukuran for the dataset.
     */
    public function ukuran()
    {
        return $this->belongsTo(Ukuran::class, 'ukuran_id');
    }

    /**
     * The tags that belong to the dataset.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'dataset_tags');
    }
}
