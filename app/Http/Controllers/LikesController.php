<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comments;
class LikesController extends Controller
{
    public function LikePostingan(int $id)
    {
        $postingan = Postingan::findOrFail($id);
        $sender_id = Auth::user()->id;
        $recipient_id = $postingan->User->id;
        $checkLike = Likes::where("sender_id", $sender_id)->where("recipient_id", $recipient_id)->where("postingan_id", $postingan->id)->where("status", "postingan")->count();
        if ($checkLike == 1) {
            Likes::where("sender_id", $sender_id)->where("recipient_id", $recipient_id)->where("postingan_id", $postingan->id)->where("status", "postingan")->delete();
        } else {
            Likes::create([
                'sender_id' => $sender_id,
                'recipient_id' => $recipient_id,
                'postingan_id' => $id,
                'status' => 'postingan'
            ]);
        }
        $countLike = Likes::where('postingan_id', $id)->count();
        return response()->json([
            'success' => true,
            'countLike' => $countLike,
        ]);
    }

    public function LikeCommentPostingan(int $post_id, int $comment_id)
    {
        $postingan = Postingan::findOrFail($post_id);
        $comment = Comments::findOrFail($comment_id);
        $sender_id = Auth::user()->id;
        $recipient_id = $comment->Sender->id;
        $checkLike = Likes::where("sender_id", $sender_id)->where("recipient_id", $recipient_id)->where("postingan_id", $post_id)->where("comment_id", $comment_id)->where("status", "komentar")->count();
        if ($checkLike == 1) {
            Likes::where("sender_id", $sender_id)->where("recipient_id", $recipient_id)->where("postingan_id", $post_id)->where("comment_id", $comment_id)->where("status", "komentar")->delete();
        } else {
            Likes::create([
                'sender_id' => $sender_id,
                'recipient_id' => $recipient_id,
                'postingan_id' => $post_id,
                'comment_id' => $comment_id,
                'status' => 'komentar'
            ]);
        }
        $countLike = Likes::where('postingan_id', $post_id)->where('comment_id', $comment_id)->count();
        return response()->json([
            'success' => true,
            'countLike' => $countLike,
        ]);
    }
}
