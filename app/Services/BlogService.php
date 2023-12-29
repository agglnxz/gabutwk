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
    public function store(Request $request) {
        $validate = Validator::make($request->all(), [
            'user_id' => 'required',
            'judul_blog' => 'required|max:25',
            'isi_blog' => 'required',
            'foto_blog' => 'required|max:50000|image|mimes:png,jpg,jpeg,gif'
        ]);
        if($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors()->first());
        }
        $this->BlogRepository->store($request->all());
    }
    public function update(Request $request, Blogs $blog) {
        $validate = Validator::make($request->all(), [
            'user_id' => 'required',
            'judul_blog' => 'required|max:25',
            'isi_blog' => 'required',
            'foto_blog' => 'required|max:50000|image|mimes:png,jpg,jpeg,gif'
        ]);
        if($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors()->first());
        }
        $this->BlogRepository->update($request->all(), $blog);
    }
    public function destroy(Blogs $blog) {
        $this->BlogRepository->destroy($blog);
    }
}
