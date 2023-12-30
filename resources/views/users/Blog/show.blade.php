@extends('layouts.app')
@section('content')
<div class="container">
    <button type="button" class="btn btn-primary mb-3">
        <a href="/blog" style="color: white;">Kembali</a>
    </button>
    <div class="card">
        <div class="card-header">
            <h3>
                <b>{{ $blog->judul_blog }}</b>
            </h3>
        </div>
        <div class="card-body">
            <img width="100%" height="400px" style="object-fit: cover;" src="{{ asset('storage/'.$blog->foto_blog) }}" alt="{{ $blog->foto_blog }}">
            <span class="my-2 text-primary"> Dibuat pada : {{ \Carbon\Carbon::parse($blog->created_at)->locale('id_ID')->diffForHumans() }} </span>
            <article class="mt-3">
                {!! $blog->isi_blog !!}
            </article>
        </div>
    </div>
</div>
@endsection
