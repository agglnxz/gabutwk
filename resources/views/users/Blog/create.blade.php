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
                Tambah Blog
            </div>
            <div class="card-body">
                <form action="{{ route('blog.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="mb-3">
                        <label for="Judul" class="form-label">Judul Blog</label>
                        <input type="text" name="judul_blog" id="Judul" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="Foto" class="form-label">Foto Blog</label>
                        <input type="file" name="foto_blog" id="Foto" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="Isi" class="form-label">Isi Blog</label>
                        <textarea name="isi_blog" id="Isi" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
