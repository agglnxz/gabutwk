<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Services\BlogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $blogs = Blogs::where('user_id', Auth::user()->id)->get();
        return view("users.Blog.index", compact("blogs"));
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
        $this->BlogService->store_blog($request);
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
        $this->BlogService->update_blog($request, $blog);
        return redirect()->back()->with('success', 'Sukses mengupdate blog!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blogs $blog)
    {
        $this->BlogService->destroy_blog($blog);
        return redirect()->back()->with('success', 'Sukses menghapus blog!');
    }
}
