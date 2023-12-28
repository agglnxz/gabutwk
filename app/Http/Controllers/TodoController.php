<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodoService;
use App\Models\Todo;
class TodoController extends Controller
{
    protected $TodoService;
    public function __construct(TodoService $TodoService)
    {
        $this->TodoService = $TodoService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todo = Todo::all();
        return view('users.Todo.index', compact("todo"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->TodoService->StoreTodo($request);
        return redirect()->back()->with('success', 'Sukses menambahkan todo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $this->TodoService->UpdateTodo($request, $todo);
        return redirect()->back()->with('success', 'Sukses mengupdate todo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $this->TodoService->DeleteTodo($todo);
        return redirect()->back()->with('success', 'Sukses menghapus todo!');
    }
}
