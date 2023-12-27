<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postingan extends Model
{
    use HasFactory;
    protected $table = "postingan";
    protected $fillable = [
        'user_id',
        'postingan',
        'deskripsi'
    ];
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
