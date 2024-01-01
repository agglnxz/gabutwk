<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = 'false';

    protected static function boot() {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function Postingan() {
        return $this->hasMany(Postingan::class, 'user_id');
    }

    public function SenderLike() {
        return $this->hasMany(Likes::class, 'sender_id');
    }

    public function RecipientLike() {
        return $this->hasMany(Likes::class, 'recipient_id');
    }
    public function SenderComment() {
        return $this->hasMany(Comments::class, 'sender_id');
    }

    public function RecipientComment() {
        return $this->hasMany(Comments::class, 'recipient_id');
    }
    public function Todo() {
        return $this->hasMany(Todo::class, 'user_id');
    }
    public function Blog() {
        return $this->hasMany(Blogs::class, 'user_id');
    }
}
