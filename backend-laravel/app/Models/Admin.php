<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Enums\AdminRole;

class Admin extends Authenticatable
{
    use Notifiable;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /*
    |--------------------------------------------------------------------------
    | Hidden Fields
    |--------------------------------------------------------------------------
    */

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'role' => AdminRole::class,
        'email_verified_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | ROLE CHECKERS (ENUM SAFE)
    |--------------------------------------------------------------------------
    */

    public function isSuperAdmin(): bool
    {
        return $this->role === AdminRole::SUPER_ADMIN;
    }

    public function isAdmin(): bool
    {
        return $this->role === AdminRole::ADMIN;
    }

    public function isStaff(): bool
    {
        return $this->role === AdminRole::STAFF;
    }

    /*
    |--------------------------------------------------------------------------
    | Flexible Role Checker
    |--------------------------------------------------------------------------
    */

    public function hasRole(AdminRole|array $roles): bool
    {
        return in_array($this->role, (array) $roles, true);
    }
}