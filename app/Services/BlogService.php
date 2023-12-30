<?php

namespace App\Services;

use App\Models\Blogs;
use App\Repositories\BlogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogService
{
    protected $BlogRepository;
    public function __construct(BlogRepository $BlogRepository)
    {
        $this->BlogRepository = $BlogRepository;
    }
    public function store_blog(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'user_id' => 'required',
            'judul_blog' => 'required|max:25',
            'isi_blog' => 'required',
            'foto_blog' => 'required|max:50000|mimes:png,jpg,jpeg,gif'
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors()->first());
        }
        $this->BlogRepository->store($request->all());
    }
    public function update_blog(Request $request, Blogs $blog)
    {
        $validate = Validator::make($request->all(), [
            'judul_blog' => 'required|max:25',
            'isi_blog' => 'required',
            'foto_blog' => 'max:50000|mimes:png,jpg,jpeg,gif'
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors()->first());
        }
        if ($request->has('foto_blog')) {
            $this->BlogRepository->delete_file($blog->foto_blog);
            $this->BlogRepository->update_file($blog, $request->foto_blog, 'foto_blog');
        }
        $this->BlogRepository->update($request->all(), $blog);
    }
    public function destroy_blog(Blogs $blog)
    {
        $this->BlogRepository->destroy($blog);
    }
}
