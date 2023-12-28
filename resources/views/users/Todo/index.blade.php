@extends('layouts.app')
@section('content')
<div class="container">
    <h3 class="text-center">
        <a href="/todo">TodoApp with SOLID PRINCIPAL</a>
    </h3>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Tambah
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('todo.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="mb-3">
                            <label for="tugas" class="form-label">Tugas</label>
                            <input type="text" name="tugas" id="tugas" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                            <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_akhir" class="form-label">Tanggal Awal</label>
                            <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Tugas</th>
                <th scope="col">Tanggal Awal</th>
                <th scope="col">Tanggal Akhir</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($todo as $nomer => $item)
                <tr>
                    <th scope="row">{{ $nomer += 1 }}</th>
                    <td>{{ $item->tugas }}</td>
                    <td>{{ $item->tanggal_awal }}</td>
                    <td>{{ $item->tanggal_akhir }}</td>
                    <td class="d-flex justify-content-start">
                        <form action="{{ route('todo.destroy', $item->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning mx-2" data-bs-toggle="modal"
                            data-bs-target="#exampleModal{{ $item->id }}">
                            Edit
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('todo.update', $item->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            <div class="mb-3">
                                                <label for="tugas" class="form-label">Tugas</label>
                                                <input type="text" name="tugas" value="{{ $item->tugas }}" id="tugas" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                                                <input type="date" name="tanggal_awal" value="{{ $item->tanggal_awal }}" id="tanggal_awal"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggal_akhir" class="form-label">Tanggal Awal</label>
                                                <input type="date" name="tanggal_akhir" value="{{ $item->tanggal_akhir }}" id="tanggal_akhir"
                                                    class="form-control">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
