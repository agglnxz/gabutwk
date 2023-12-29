<?php

namespace App\Contracts;
use App\Models\Todo;
interface TodoInterface{
    public function store(array $data);
    public function update(array $data, Todo $todo);
    public function delete(Todo $todo);
}


