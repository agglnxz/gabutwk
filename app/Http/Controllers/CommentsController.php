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
        if($request->parent_comment != null) {
            $comment = Comments::findOrFail($request->parent_comment);
            $new_comment = Comments::create([
                'sender_id' => Auth::user()->id,
                'recipient_id' => $comment->Sender->id,
                'postingan_id' => $id,
                'parent_comment_id' => $request->parent_comment,
                'komentar' => $request->komentar,
            ]);
            return response()->json([
                'success' => true,
                'foto_profile' => $new_comment->Sender->foto_profile,
                'nama' => $new_comment->Sender->name,
                'nama_penerima' => '@'.$new_comment->Recipient->name,
                'komentar' => $request->komentar,
                'postingan_id' => $id,
                'comment_id' => $new_comment->id
            ]);
        } else {
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
                'nama_penerima' => '',
                'komentar' => $request->komentar,
                'postingan_id' => $id,
                'comment_id' => $new_comment->id
            ]);
        }

    }
}
