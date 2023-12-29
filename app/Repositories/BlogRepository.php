<?php

namespace App\Repositories;
use App\Contracts\BlogInterface;
use App\Models\Blogs;
class BlogRepository implements BlogInterface
{
    public function __construct()
    {
        //
    }
    public function store(array $data) {
        return Blogs::create($data);
    }
    public function update(array $data, Blogs $blog) {
        return $blog->update($data);
    }
    public function destroy(Blogs $blog) {
        return $blog->delete();
    }
}
