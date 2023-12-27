<?php

namespace App\Http\Controllers;

use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PostinganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'postingan' => 'required|mimes:png,jpg,mp4,mkv,avi,jpeg,gif|max:50000',
            'deskripsi' => 'required|max:225'
        ], [
            'postingan.required' => 'Postingan harus diisi!',
            'postingan.mimes' => 'Extensi postingan tidak valid!',
            'postingan.max' => 'Maksimal postingan 50MB!',
            'deskripsi.required' => 'Postingan harus diisi!',
            'deskripsi.max' => 'Deskripsi postingan maksimal 225 karakter'
        ]);
        if($validate->fails()) {
            return response()->json($validate->errors()->first(), 422);
        }
        $create = Postingan::create([
            'user_id' => Auth::user()->id,
            'postingan' => $request->file('postingan')->store('postingan', 'public'),
            'deskripsi' => $request->deskripsi
        ]);
        if($create) {
            return response()->json([
                'message' => 'Sukses menambahkan postingan.'
            ]);
        }
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
