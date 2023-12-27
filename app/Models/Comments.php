<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $table = "comments";
    protected $fillable = [
        'sender_id',
        'recipient_id',
        'postingan_id',
        'komentar',
        'parent_comment_id'
    ];
    public function Sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function Recipient() {
        return $this->belongsTo(User::class, 'recipient_id');
    }
    public function Postingan() {
        return $this->belongsTo(Postingan::class, 'postingan_id');
    }
    public function Like() {
        return $this->hasMany(Likes::class, 'comment_id');
    }
    public function CountLike() {
        return Likes::where('comment_id', $this->id)->count();
    }
    public function IsLike(int $id) {
        return Likes::where('comment_id', $this->id)->where('sender_id', $id)->exists();
    }
}
