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
use App\Models\Team;

class Dataset extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'datasets';

    protected $fillable = [
        'id_team', // Sesuai dengan migration
        'judul',
        'slug',
        'deskripsi_dataset',
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
        // Kolom resource yang ada di migration
        'nama_resource',
        'deskripsi_resource',
        'satuan_id',
        'ukuran_id',
        'file_path',
        'format',
        'ukuran_file',
        'terakhir_diubah',
        'jumlah_diunduh',
        'kepatuhan_standar_data',
        'jumlah_dilihat',
    ];

    protected $casts = [
        'tanggal_rilis' => 'date',
        'tanggal_modifikasi_metadata' => 'date',
        'terakhir_diubah' => 'datetime',
        'is_publik' => 'boolean',
        'metadata_tambahan' => 'array',
        'jumlah_dilihat' => 'integer',
        'jumlah_diunduh' => 'integer',
        'ukuran_file' => 'integer',
    ];

    /**
     * Get the team that owns the dataset.
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'id_team');
    }

    /**
     * Get the organization that owns the dataset (if still needed).
     */


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
    public function satuan(): BelongsTo
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }

    /**
     * Get the ukuran for the dataset.
     */
    public function ukuran(): BelongsTo
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
