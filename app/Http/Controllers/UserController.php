<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function config()
    {
        return view('user.config');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $id = Auth::user()->id;

        $request->validate([
            'name' => 'required|string|max:255',
            'nick' => 'required|string|max:100|unique:users,nick,' . $id,
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'image' => 'required|file',
        ]);

        $user->name = $request->input('name');
        $user->nick = $request->input('nick');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');

        $image = $request->file('image');

        if ($image) {
            $image_path = time() . $image->getClientOriginalName();
            Storage::disk('users')->put($image_path, File::get($image));
            $user->image = $image_path;
        }


        $user->update();

        return redirect()->route('user.config')->with('message', 'El usuario se modificó correctamente');
    }

    public function getImage($filename)
    {
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

    public function profile($id)
    {
        $user = User::find($id);
        return view('user.profile', ['user' => $user]);
    }

    public function users(Request $request)
    {

        $search = $request->input('search');

        if ($search && !empty($search)) {
            $users = User::where('nick', 'LIKE', '%' . $search . '%')
                ->orWhere('name', 'LIKE', '%' . $search . '%')
                ->orWhere('surname', 'LIKE', '%' . $search . '%')
                ->orderBy('id', 'desc')->paginate(5);
        } else {
            $users = User::orderBy('id', 'desc')->paginate(5);
        }
        return view('user.users', ['users' => $users]);
    }
}
