@extends('layouts.app')
@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger mb-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button type="button" class="btn btn-primary mb-3">
            <a href="/blog" style="color: white;">Kembali</a>
        </button>
        <div class="card">
            <div class="card-header text-center">
                Edit Blog
            </div>
            <div class="card-body">
                <form action="{{ route('blog.update', $blog->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="Judul" class="form-label">Judul Blog</label>
                        <input type="text" name="judul_blog" value="{{ $blog->judul_blog }}" id="Judul" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="Foto" class="form-label">Foto Blog</label> <br>
                        <img src="{{ asset('storage/'.$blog->foto_blog) }}" class="mb-3" width="200px" alt="{{ $blog->foto_blog }}">
                        <input type="file" name="foto_blog" id="Foto" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="Isi" class="form-label">Isi Blog</label>
                        <textarea name="isi_blog" id="Isi" class="form-control" cols="30" rows="10">{!! $blog->isi_blog !!}</textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
