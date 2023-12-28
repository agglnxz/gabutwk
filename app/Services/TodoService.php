<?php

namespace App\Services;
use App\Models\Todo;
use App\Repositories\TodoRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoService
{
    protected $TodoRepositoryInterface;
    public function __construct(TodoRepositoryInterface $TodoRepositoryInterface)
    {
        $this->TodoRepositoryInterface = $TodoRepositoryInterface;
    }
    public function StoreTodo(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'tugas' => 'required|max:25',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date'
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first());
        }
        $this->TodoRepositoryInterface->store($request->all());
    }
    public function UpdateTodo(Request $request, Todo $todo) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'tugas' => 'required|max:25',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date'
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first());
        }
        $this->TodoRepositoryInterface->update($request->all(), $todo);
    }
    public function DeleteTodo(Todo $todo) {
        $this->TodoRepositoryInterface->delete($todo);
    }
}
