<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = [
        'user_id',
        'judul_blog',
        'foto_blog',
        'isi_blog'
    ];
    public function User() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
