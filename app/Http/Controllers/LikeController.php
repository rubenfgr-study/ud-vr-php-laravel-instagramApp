<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Class constructor.
     */
    public function __construc()
    {
        $this->middleware('auth');
    }

    public function like($image_id)
    {
        $user = Auth::user();

        $isset_like = Like::where('user_id', $user->id)->where('image_id', $image_id)->count();

        if ($isset_like == 0) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;

            $like->save();

            return response()->json(['like', $like]);
        } else {
            return response()->json(['message' => 'El like ya esta hecho']);
        }
    }

    public function dislike($image_id)
    {
        $user = Auth::user();

        $likes = Like::where('user_id', $user->id)->where('image_id', $image_id)->get();

        if (sizeof($likes)) {
            foreach ($likes as $like) {
                $like->delete();
            }

            return response()->json(['likes' => $likes, 'message' => 'El like se ha eliminado correctamente']);
        } else {
            return response()->json(['message' => 'El like ya esta eliminado']);
        }
    }

    public function likes()
    {
        $user = Auth::user();
        $likes = Like::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(5);
        $test = new Like();
        $test->all()->forPage(5, 20);
        return view('like.likes', ['likes' => $likes]);
    }
}
