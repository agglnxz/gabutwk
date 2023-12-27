<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function StoreCommentPostingan(Request $request, $id) {
        $postingan = Postingan::findOrFail($id);
        $new_comment = Comments::create([
            'sender_id' => Auth::user()->id,
            'recipient_id' => $postingan->User->id,
            'postingan_id' => $id,
            'komentar' => $request->komentar,
        ]);
        return response()->json([
            'success' => true,
            'foto_profile' => $new_comment->Sender->foto_profile,
            'nama' => $new_comment->Sender->name,
            'komentar' => $request->komentar
        ]);
    }
}
