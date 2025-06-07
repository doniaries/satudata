<?php

namespace App\Models;

use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{

    use Notifiable, HasFactory, HasRoles, HasPanelShield;


    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];


    public function canImpersonate()
    {
        return true;
    }


    public function getTenants(Panel $panel): Collection
    {
        return $this->teams;
    }

    public function team()
    {
        return $this->teams()
            ->where('teams.id', Filament::getTenant()?->id);
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class)
            ->withTimestamps();
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->teams->contains($tenant);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    // Tambahkan method untuk cek status
    public function isActive(): bool
    {
        return $this->is_active;
    }

    // Method untuk mencegah login jika tidak aktif
    protected static function booted()
    {
        static::creating(function ($user) {
            $user->is_active = true; // Set default ke aktif
        });
    }
}
