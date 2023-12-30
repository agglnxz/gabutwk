@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-start mb-3 gap-4">
            <button type="button" class="btn btn-primary">
                <a href="{{ route('blog.create') }}" style="color: white;">Tambah Blog</a>
            </button>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
        </div>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach ($blogs as $blog)
                <div class="col">
                    <div class="card" style="height: 300px;overflow-y:auto;">
                        <img style="object-fit:cover;height:200px;" src="{{ asset('storage/' . $blog->foto_blog) }}"
                            class="card-img-top" alt="{{ $blog->foto_blog }}" />
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('blog.show', $blog->id) }}">{{ $blog->judul_blog }}</a>
                            </h5>
                            <p class="card-text text-truncate">
                                {!! Str::limit($blog->isi_blog, 150, '...') !!}
                            </p>
                        </div>
                        @if (Auth::user()->id == $blog->User->id)
                            <div class="d-flex mx-2">
                                <a href="#" data-bs-target="#ModalConfirmationDelete{{ $blog->id }}"
                                    data-bs-toggle="modal">
                                    <svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="28"
                                        height="28" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M7 21q-.825 0-1.412-.587T5 19V6q-.425 0-.712-.288T4 5q0-.425.288-.712T5 4h4q0-.425.288-.712T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5q0 .425-.288.713T19 6v13q0 .825-.587 1.413T17 21zm3-4q.425 0 .713-.288T11 16V9q0-.425-.288-.712T10 8q-.425 0-.712.288T9 9v7q0 .425.288.713T10 17m4 0q.425 0 .713-.288T15 16V9q0-.425-.288-.712T14 8q-.425 0-.712.288T13 9v7q0 .425.288.713T14 17" />
                                    </svg>
                                </a>
                                <div class="modal" tabindex="-1" id="ModalConfirmationDelete{{ $blog->id }}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"><b>Konfirmasi Hapus Blog</b></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <form action="{{ route('blog.destroy', $blog->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <p>Apakah anda yakin mau menghapus blog ini?</p>
                                                    <div class="d-flex justify-content-center gap-3">
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                        <button type="button" class="btn btn-light"
                                                            style="border: 1px solid black;"
                                                            data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('blog.edit', $blog->id) }}">
                                    <svg class="text-warning" xmlns="http://www.w3.org/2000/svg" width="28"
                                        height="28" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M6 22q-.825 0-1.412-.587T4 20V4q0-.825.588-1.412T6 2h8l6 6v3q-.575.125-1.075.4t-.925.7l-6 5.975V22zm8 0v-3.075l5.525-5.5q.225-.225.5-.325t.55-.1q.3 0 .575.113t.5.337l.925.925q.2.225.313.5t.112.55q0 .275-.1.563t-.325.512l-5.5 5.5zm6.575-5.6l.925-.975l-.925-.925l-.95.95zM13 9h5l-5-5l5 5l-5-5z" />
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
