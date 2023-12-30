<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Postingan extends Model
{
    use HasFactory;
    protected $primaryKey = 'uuid';
    protected $keyType = "string";
    public $incrementing = false;
    protected $table = "postingan";
    protected $fillable = [
        'user_id',
        'postingan',
        'deskripsi'
    ];
    protected static function boot() {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }
    public function User() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function Like() {
        return $this->hasMany(Likes::class, 'postingan_id');
    }
    public function IsLike($user) {
        return Likes::where('postingan_id', $this->id)->where('sender_id', $user)->exists();
    }
    public function CountLike() {
        return Likes::where('postingan_id', $this->id)->count();
    }
    public function Comment() {
        return $this->hasMany(Comments::class, 'postingan_id');
    }
    public function CountComment() {
        return Comments::where('postingan_id', $this->id)->count();
    }
}
