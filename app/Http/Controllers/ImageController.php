<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Like;
use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('image.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'image_path' => 'required|image|mimes:png,jpg',
            'description' => 'required|string'
        ]);

        $image_path = $request->file('image_path');
        $description = $request->input('description');

        $user = Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        $image->description = $description;

        if ($image_path) {
            $image_path_full = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_full, File::get($image_path));
            $image->image_path = $image_path_full;
        }

        $image->save();

        return redirect()->route('image.create')->with('message', 'La imagen se cargo con éxtio');
    }

    public function getImage($filename)
    {
        try {
            $file = Storage::disk('images')->get($filename);
        } catch (FileNotFoundException $e) {
            return null;
        }
        return new Response($file, 200);
    }

    public function detail($id)
    {
        $image = Image::find($id);
        return view('image.detail', ['image' => $image]);
    }

    public function delete(Image $image)
    {
        $user = Auth::user();
        $comments = Comment::where('image_id', $image->id)->get();
        $likes = Like::where('image_id', $image->id)->get();

        if ($user && $image && $image->user_id == $user->id) {

            if ($comments && sizeof($comments) > 0) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }

            if ($likes && sizeof($likes) > 0) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }



            Storage::disk('images')->delete($image->image_path);

            $image->delete();
            return redirect()->route('dashboard')->with('message', 'La imagen se eliminó con éxito!');
        } else {
            return redirect()->route('image.detail', ['id' => $image->id])->with('message', 'La imagen no se ha podido eliminar');
        }
    }

    public function edit(Image $image)
    {

        $user = Auth::user();

        if ($user && $image && $image->user->id == $user->id) {
            return view('image.edit', ['image' => $image]);
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function update(Request $request, Image $image)
    {

        $request->validate([
            'image_path' => 'image|mimes:png,jpg',
            'description' => 'required|string'
        ]);

        $description = $request->input('description');
        $image_path = $request->file('image_path');

        $image->description = $description;

        if ($image_path) {
            $image_path_full = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_full, File::get($image_path));
            $image->image_path = $image_path_full;
        }

        // return response()->json(["image_id" => $image_id, "description" => $description]);
        $image->update();

        return redirect()->route('image.detail', ['id' => $image->id])->with('message', 'Imagen actualizada con éxito!');
    }
}
