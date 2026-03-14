<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'is_active',
        'is_verified',
        'verification_token',
    ];

    protected $casts = [
        // FIX: cast boolean agar bisa dipakai langsung sebagai true/false
        'is_verified' => 'boolean',
        'is_active'   => 'boolean',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    /* ── Scopes ─────────────────────────────────────────── */

    /** Hanya subscriber yang sudah verifikasi email */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /** Hanya subscriber yang aktif */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}