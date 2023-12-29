<?php

namespace App\Repositories;
use App\Models\Todo;
use App\Contracts\TodoInterface;
class EloquentTodoRepository implements TodoInterface
{
    public function __construct()
    {
        //
    }
    public function store(array $data) {
        return Todo::create($data);
    }
    public function update(array $data, Todo $todo) {
        return $todo->update($data);
    }
    public function delete(Todo $todo) {
        return $todo->delete();
    }
}
