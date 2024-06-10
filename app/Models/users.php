<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class users extends Authenticatable
{
    use HasFactory, HasApiTokens;
    protected $table = "users";
    protected $fillable = ['username', 'name', 'email', 'password', 'remember_token', 'created_at', 'updated_at'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($users) {
            $users->remember_token = \Illuminate\Support\Str::uuid();
        });
    }
}
