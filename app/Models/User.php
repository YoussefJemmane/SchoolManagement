<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'image',
        'role',
    ];

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
    ];

    public function students() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Student::class, 'user_id');
    }

    public function enseignants() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Enseignant::class, 'user_id');
    }

    public function admins() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Admin::class, 'user_id');
    }
}
