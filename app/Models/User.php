<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'role_id',
        'bio',
        'resume',
        'address',
        'region',
        'is_verified',
    ];

    public function companies()
    {
        return $this->hasOne(companies::class, 'owner_id');
    }

    public function educations()
    {
        return $this->hasMany(UserEducations::class);
    }

    public function skills()
    {
        return $this->belongsToMany(skills::class, 'user_skills', 'user_id', 'skill_id');
    }

    public function applications()
    {
        return $this->hasMany(applications::class);
    }

    public function matchResults()
    {
        return $this->hasMany(MatchResults::class);
    }

    public function badges()
    {
        return $this->belongsToMany(badges::class, 'user_badges');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_verified' => 'boolean',
    ];
}
