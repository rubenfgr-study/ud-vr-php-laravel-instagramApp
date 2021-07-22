<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image_id' => 'required|integer',
            'content' => 'required|string|min:5'
        ]);

        $image_id = $request->input('image_id');
        $content = $request->input('content');
        $user_id = Auth::user()->id;

        $comment = new Comment();
        $comment->image_id = $image_id;
        $comment->content = $content;
        $comment->user_id = $user_id;

        $comment->save();

        return redirect()->route('image.detail', ["id" => $image_id]);
    }

    public function delete($id)
    {
        $user = Auth::user();
        $comment = Comment::find($id);

        if ($user->id === $comment->user_id || $comment->image->user_id === $user->id) {
            $comment->delete();
            return redirect()->route('image.detail', ["id" => $comment->image->id])->with('message', 'Comentario eliminado correctamente');
        } else {
            return redirect()->route('image.detail', ["id" => $comment->image->id])->with('message', 'El comentario no se ha podido eliminar');
        }
    }
}
