@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-center">
        <div class="d-flex justify-content-between text-center" style="width: 42rem;">
            <svg onclick="Redirect()" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                <path fill="currentColor" d="m7.825 13l5.6 5.6L12 20l-8-8l8-8l1.425 1.4l-5.6 5.6H20v2z" />
            </svg>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Postingan Anda.
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Postingan Anda.</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="loading" class="text-center">
                            </div>
                            <form action="{{ route('postingan.store') }}" id="FormTambahPostingan" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="postingan" id="postingan" class="form-control" required>
                                <textarea name="deskripsi" id="deskripsi" class="form-control mt-2 mb-2" cols="30" rows="10" required></textarea>
                                <button type="button" onclick="ButtonTambahPostingan()"
                                    class="btn btn-primary">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <svg onclick="Redirect()" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                <path fill="currentColor" d="M16.175 13H4v-2h12.175l-5.6-5.6L12 4l8 8l-8 8l-1.425-1.4z" />
            </svg>
        </div>
    </div>
    @if ($count_postingan == 0)
    @else
        <div class="d-flex justify-content-center">
            <!--Section: Newsfeed-->
            <section>
                <div class="card" style="max-width: 42rem">
                    <div class="card-body">
                        <!-- Data -->
                        <div class="d-flex mb-3">
                            <a href="">
                                <img src="{{ asset($postingan->User->foto_profile) }}" class="border rounded-circle me-2"
                                    alt="Avatar" style="height: 50px;width:50px;object-fit:cover;" />
                            </a>
                            <div>
                                <a href="" class="text-dark mb-0">
                                    <strong>{{ $postingan->User->name }}</strong>
                                </a>
                                <a href="" class="text-muted d-block" style="margin-top: -6px">
                                    <small>{{ \Carbon\Carbon::parse($postingan->created_at)->locale('id_ID')->diffForHumans() }}</small>
                                </a>
                            </div>
                        </div>
                        <!-- Description -->
                        <div>
                            <p>
                                {{ $postingan->deskripsi }}
                            </p>
                        </div>
                    </div>
                    <!-- Media -->
                    <div class="bg-image hover-overlay ripple rounded-0" data-mdb-ripple-color="light">
                        @php
                            $extension_postingan = pathinfo($postingan->postingan, PATHINFO_EXTENSION);
                            $extension_video = ['mp4', 'mkv', 'avi'];
                            $extension_gambar = ['png', 'jpg', 'jpeg', 'gif'];
                        @endphp
                        @if (in_array($extension_postingan, $extension_gambar))
                            <img src="{{ asset('storage/' . $postingan->postingan) }}" alt="{{ $postingan->postingan }}"
                                class="w-100" />
                        @else
                            <video style="width:100%;height:100%;" controls>
                                <source src="{{ asset('storage/' . $postingan->postingan) }}" type="video/mp4">
                            </video>
                        @endif
                        <a href="#!">
                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                        </a>
                    </div>
                    <!-- Media -->
                    <!-- Interactions -->
                    <div class="card-body">

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between text-center border-top border-bottom mb-4">
                            <div class="d-flex justify-content-start my-2">
                                @if ($postingan->IsLike(Auth::user()->id))
                                    <svg onclick="LikePostingan({{ $postingan->id }})" class="text-primary" id="likePost"
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 256 256">
                                        <path fill="currentColor"
                                            d="M234 80.12A24 24 0 0 0 216 72h-56V56a40 40 0 0 0-40-40a8 8 0 0 0-7.16 4.42L75.06 96H32a16 16 0 0 0-16 16v88a16 16 0 0 0 16 16h172a24 24 0 0 0 23.82-21l12-96A24 24 0 0 0 234 80.12M32 112h40v88H32Z" />
                                    </svg>
                                @else
                                    <svg onclick="LikePostingan({{ $postingan->id }})" class="text-dark" id="likePost"
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 256 256">
                                        <path fill="currentColor"
                                            d="M234 80.12A24 24 0 0 0 216 72h-56V56a40 40 0 0 0-40-40a8 8 0 0 0-7.16 4.42L75.06 96H32a16 16 0 0 0-16 16v88a16 16 0 0 0 16 16h172a24 24 0 0 0 23.82-21l12-96A24 24 0 0 0 234 80.12M32 112h40v88H32Z" />
                                    </svg>
                                @endif
                                <span id="countLikePost">{{ $postingan->CountLike() }}</span>
                            </div>
                            <div class="d-flex justify-content-start my-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M9 22a1 1 0 0 1-1-1v-3H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-6.1l-3.7 3.71c-.2.19-.45.29-.7.29z" />
                                </svg>
                                <span>{{ $postingan->CountComment() }}</span>
                            </div>
                            <div class="d-flex justify-content-start my-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M18.002 21.5q-1.04 0-1.771-.73q-.731-.728-.731-1.77q0-.2.035-.413q.034-.214.103-.402l-7.742-4.562q-.367.414-.854.645Q6.556 14.5 6 14.5q-1.042 0-1.77-.728q-.73-.729-.73-1.77q0-1.04.73-1.771Q4.957 9.5 6 9.5q.556 0 1.042.232q.487.231.854.645l7.742-4.562q-.069-.188-.103-.402Q15.5 5.2 15.5 5q0-1.042.729-1.77q.728-.73 1.769-.73q1.04 0 1.771.729q.731.728.731 1.769q0 1.04-.73 1.771q-.728.731-1.77.731q-.556 0-1.042-.232q-.487-.231-.854-.645l-7.742 4.562q.069.188.103.4q.035.213.035.411q0 .198-.035.415q-.034.216-.103.404l7.742 4.562q.367-.414.854-.645q.486-.232 1.042-.232q1.042 0 1.77.729q.73.728.73 1.769q0 1.04-.728 1.771q-.729.731-1.77.731" />
                                </svg>
                                <span>0</span>
                            </div>
                        </div>
                        <!-- Buttons -->

                        <!-- Comments -->

                        <!-- Input -->
                        <div class="d-flex mb-3">
                            <a href="">
                                <img src="{{ asset($postingan->User->foto_profile) }}" class="border rounded-circle me-2"
                                    alt="Avatar" style="height: 45px;width:45px;object-fit:cover;" />
                            </a>
                            <div class="form-outline w-100">
                                <form id="FormStoreComment"
                                    action="{{ route('store.comment.postingan', $postingan->id) }}" method="post">
                                    @csrf
                                    <label class="form-label" for="TextareaStoreComment">Bagikan komentar anda mengenai
                                        postingan
                                        ini.</label>
                                    <textarea id="TextareaStoreComment" name="komentar" class="form-control" rows="2"
                                        placeholder="Tulis komentar..."></textarea>
                                    <button type="submit" onclick="StoreComment({{ $postingan->id }})"
                                        class="btn btn-primary float-end my-2">Kirim</button>
                                </form>
                            </div>
                        </div>
                        <!-- Input -->

                        <div id="new-comment">

                        </div>
                        <!-- Answers -->
                        @foreach ($postingan->Comment as $item)
                            <!-- Single answer -->
                            <div class="d-flex mb-3">
                                <a href="">
                                    <img src="{{ $item->Sender->foto_profile }}" class="border rounded-circle me-2"
                                        alt="Avatar" style="height: 40px;width:40px;object-fit:cover;" />
                                </a>
                                <div>
                                    <div class="bg-light rounded-3 px-3 py-1">
                                        <a class="text-dark mb-0">
                                            <strong>{{ $item->Sender->name }}</strong>
                                        </a>
                                        <a class="text-muted d-block">
                                            <small>{{ $item->komentar }}</small>
                                        </a>
                                    </div>
                                    <a class="text-muted small ms-3 me-2">
                                        @if ($item->IsLike(Auth::user()->id))
                                            <svg onclick="LikeComment({{ $postingan->id }},{{ $item->id }})"
                                                class="text-primary" id="likeComment{{ $item->id }}"
                                                xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 256 256">
                                                <path fill="currentColor"
                                                    d="M234 80.12A24 24 0 0 0 216 72h-56V56a40 40 0 0 0-40-40a8 8 0 0 0-7.16 4.42L75.06 96H32a16 16 0 0 0-16 16v88a16 16 0 0 0 16 16h172a24 24 0 0 0 23.82-21l12-96A24 24 0 0 0 234 80.12M32 112h40v88H32Z" />
                                            </svg>
                                        @else
                                            <svg onclick="LikeComment({{ $postingan->id }},{{ $item->id }})"
                                                class="text-dark" id="likeComment{{ $item->id }}"
                                                xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 256 256">
                                                <path fill="currentColor"
                                                    d="M234 80.12A24 24 0 0 0 216 72h-56V56a40 40 0 0 0-40-40a8 8 0 0 0-7.16 4.42L75.06 96H32a16 16 0 0 0-16 16v88a16 16 0 0 0 16 16h172a24 24 0 0 0 23.82-21l12-96A24 24 0 0 0 234 80.12M32 112h40v88H32Z" />
                                            </svg>
                                        @endif
                                        <span id="CountLikeComment{{ $item->id }}">{{ $item->CountLike() }}</span>
                                    </a>
                                    <a
                                        class="text-muted small me-2"><strong>Reply</strong></a>
                                </div>

                            </div>
                            <!-- Input -->
                            <div class="d-flex mx-5 mb-3">
                                <a href="">
                                    <img src="{{ asset($postingan->User->foto_profile) }}"
                                        class="border rounded-circle me-2" alt="Avatar"
                                        style="height: 45px;width:45px;object-fit:cover;" />
                                </a>
                                <div class="form-outline w-100">
                                    <form id="FormStoreComment"
                                        action="{{ route('store.comment.postingan', $postingan->id) }}" method="post">
                                        @csrf

                                        <textarea id="TextareaStoreComment" name="komentar" class="form-control" rows="2"
                                            placeholder="Tulis komentar..."></textarea>
                                        <button type="submit" onclick="StoreComment({{ $postingan->id }})"
                                            class="btn btn-primary float-end my-2">Kirim</button>
                                    </form>
                                </div>
                            </div>
                            <!-- Input -->
                        @endforeach

                        <!-- Answers -->

                        <!-- Comments -->
                    </div>
                    <!-- Interactions -->
                </div>
            </section>
            <!--Section: Newsfeed-->
        </div>
    @endif
    <script>
        // like comment
        function LikeComment(postingan, comment) {
            $.ajax({
                url: '/like-komentar-postingan/' + postingan + '/' + comment,
                method: 'POST',
                headers: {
                    'X-Csrf-Token': '{{ csrf_token() }}',
                },
                success: function success(response) {
                    if (response.success) {
                        if ($("#likeComment" + comment).hasClass("text-dark")) {
                            $("#likeComment" + comment).removeClass("text-dark");
                            $("#likeComment" + comment).addClass("text-primary");
                            $("#CountLikeComment" + comment).html(response.countLike);
                        } else {
                            $("#likeComment" + comment).addClass("text-dark");
                            $("#likeComment" + comment).removeClass("text-primary");
                            $("#CountLikeComment" + comment).html(response.countLike);
                        }
                    }
                },
                error: function error(xhr, error, status) {
                    iziToast.destroy();
                    iziToast.error({
                        'title': 'Error',
                        'message': xhr.responseText,
                        'position': 'topCenter'
                    });
                }
            });
        }
        // store comment
        function StoreComment(id) {
            $("#FormStoreComment").off("submit");
            $("#FormStoreComment").submit(function(event) {
                event.preventDefault();
                let data = new FormData($(this)[0]);
                let route = $(this).attr("action");
                $.ajax({
                    url: route,
                    method: 'POST',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function success(response) {
                        $("#TextareaStoreComment").val('');
                        let new_comment = `
                        <div class="d-flex mb-3">
                                <a href="">
                                    <img src="${response.foto_profile}"
                                        class="border rounded-circle me-2" alt="Avatar" style="height: 40px;width:40px;object-fit:cover;" />
                                </a>
                                <div>
                                    <div class="bg-light rounded-3 px-3 py-1">
                                        <a href="" class="text-dark mb-0">
                                            <strong>${response.nama}</strong>
                                        </a>
                                        <a href="" class="text-muted d-block">
                                            <small>${response.komentar}</small>
                                        </a>
                                    </div>
                                    <a href="" class="text-muted small ms-3 me-2"><strong
                                            class="me-1">Like</strong><span>0</span></a>
                                    <a href="" class="text-muted small me-2"><strong>Reply</strong></a>
                                </div>
                            </div>
                        `
                        $("#new-comment").append(new_comment);
                    },
                    error: function error(xhr, error, status) {
                        iziToast.destroy();
                        iziToast.error({
                            'title': 'Error',
                            'message': xhr.responseText,
                            'position': 'topConter'
                        });
                    }
                });
            });
        }
        // like postingan
        function LikePostingan(id) {
            $.ajax({
                url: '/like-postingan/' + id,
                method: 'POST',
                headers: {
                    'X-Csrf-Token': '{{ csrf_token() }}',
                },
                success: function success(response) {
                    if (response.success) {
                        if ($("#likePost").hasClass("text-dark")) {
                            $("#likePost").removeClass("text-dark");
                            $("#likePost").addClass("text-primary");
                            $("#countLikePost").html(response.countLike);
                        } else {
                            $("#likePost").addClass("text-dark");
                            $("#likePost").removeClass("text-primary");
                            $("#countLikePost").html(response.countLike);
                        }
                    }
                },
                error: function error(xhr, error, status) {
                    iziToast.destroy();
                    iziToast.error({
                        'title': 'Error',
                        'message': xhr.responseText,
                        'position': 'topCenter'
                    });
                }
            });
        }
        // redirect
        function Redirect() {
            window.location.href = "/feed";
        }
        // tambah postingan
        function ButtonTambahPostingan() {
            let data = new FormData($("#FormTambahPostingan")[0]);
            let route = $("#FormTambahPostingan").attr("action");
            $("#loading").html(`
            <div class="spinner-border text-info" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
            `);
            $("#loading").css('display', 'block');
            $("#FormTambahPostingan").css("display", "none");
            $.ajax({
                url: route,
                data: data,
                processData: false,
                contentType: false,
                method: 'POST',
                success: function success(response) {

                    location.reload();

                },
                error: function error(xhr, response, status) {
                    iziToast.destroy();
                    $("#loading").css('display', 'none');
                    $("#FormTambahPostingan").css("display", "block");
                    iziToast.error({
                        'title': 'Error',
                        'message': xhr.responseText,
                        'position': 'topCenter'
                    });
                }
            });
        }
    </script>
@endsection
