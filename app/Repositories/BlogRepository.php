<?php

namespace App\Repositories;
use App\Contracts\BlogInterface;
use App\Contracts\UpdatedFileInterface;
use App\Contracts\UploadFileInterface;
use App\Models\Blogs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogRepository implements BlogInterface, UploadFileInterface, UpdatedFileInterface
{
    public function __construct()
    {

    }
    public function upload($file, $destination) {
        return $file->store($destination, 'public');
    }
    public function store(array $data) {
        return Blogs::create([
            'user_id' => Auth::user()->id,
            'foto_blog' => $this->upload($data['foto_blog'], 'foto_blog'),
            'judul_blog' => $data['judul_blog'],
            'isi_blog' => $data['isi_blog']
        ]);
    }
    public function update_file($model, $file, $destination) {
        return $model->update([
            'foto_blog' => $file->store($destination, 'public'),
        ]);
    }
    public function delete_file($file) {
        return Storage::delete($file);
    }
    public function update(array $data, Blogs $blog) {
        return $blog->update([
            'judul_blog' => $data['judul_blog'],
            'isi_blog' => $data['isi_blog']
        ]);
    }
    public function destroy($blog) {
        return $blog->delete();
    }
}
