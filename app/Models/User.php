<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'phone', 'is_allowed', 'lumiverse_id', 'google_id', 'avatar', 'password', 'plan_id', 'pending_plan_id', 'pending_billing_cycle', 'expires_at', 'registered_at'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attribute casts for the model.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'expires_at' => 'datetime',
        'registered_at' => 'datetime',
        'is_allowed' => 'boolean',
        'plan_id' => 'integer',
        'pending_plan_id' => 'integer',
        'password' => 'hashed',
    ];
}
