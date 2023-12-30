<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blogs extends Model
{
    use HasFactory;
    protected $primaryKey = "uuid";
    protected $keyType = "string";
    public $incrementing = false;
    protected $table = 'blogs';
    protected $fillable = [
        'user_id',
        'judul_blog',
        'foto_blog',
        'isi_blog'
    ];
    protected static function boot() {
        parent::boot();
        static::creating(function($model){
            $model->uuid = Str::uuid()->toString();
        });
    }
    public function User() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
