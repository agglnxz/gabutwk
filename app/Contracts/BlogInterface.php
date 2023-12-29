<?php

namespace App\Contracts;
use App\Models\Blogs;
interface BlogInterface{
    public function store(array $data);
    public function update(array $data, Blogs $blog);
    public function destroy(Blogs $blog);
}


