<?php

namespace App\Repositories;
use App\Models\Todo;
class EloquentTodoRepository implements TodoRepositoryInterface
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
