<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Services\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $BlogService;
    public function __construct(BlogService $BlogService)
    {
        $this->BlogService = $BlogService;
    }
    public function index()
    {
        $blog = Blogs::all();
        return view("users.Blog.index", compact("blog"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("users.Blog.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->BlogService->store($request);
        return redirect()->back()->with('success', 'Sukses menambahkan blog!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blogs $blog)
    {
        return view("users.Blog.show", compact("blog"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blogs $blog)
    {
        return view("users.Blog.edit", compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blogs $blog)
    {
        $this->BlogService->update($request, $blog);
        return redirect()->back()->with('success', 'Sukses mengupdate blog!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blogs $blog)
    {
        $this->BlogService->destroy($blog);
        return redirect()->back()->with('success', 'Sukses menghapus blog!');
    }
}
