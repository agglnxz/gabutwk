<?php

namespace App\Repositories;
use App\Models\Todo;
interface TodoRepositoryInterface
{
  public function store(array $data);
  public function update(array $data, Todo $todo);
  public function delete(Todo $todo);
}
