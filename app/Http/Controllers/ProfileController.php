<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Auth\Middleware\Authenticate;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Illuminate\Routing\Controller as Controller;



class ProfileController extends Controller
{
    public function __construct()
    {  
        $this->middleware('auth');
    }
    public function index(Request $request, User $user)
    {
        // dd('formulario');
        // dd($user->id, Auth::id());
        if($user->id != Auth::id()){
            return redirect()->route('posts.index', Auth::user()->username);
        }
        return view('profile.index',[
            'user' => $user,
        ]);
    }

    public function store(Request $request)
    {
        // dd('guardando');
        $request->request->add([
            'username' => Str::slug($request->username),
        ]);
        $request->validate([
            // 'username' => ['required','min:3','max:40','unique:users','not_in:profile-edit,devstagram,twitter','in:CLIENTE'],
            'username' => ['required','min:3','max:40','unique:users,username,'.Auth::id(),'not_in:profile-edit,devstagram,twitter'],
            // 'profileimage' => 'required',
        ]);

        if($request->profileimage){
            $image = request()->file('profileimage');
            list($imgname, $extension) = explode('.', $image->getClientOriginalName());
            $image_name = Str::uuid().'-'.date('YmdHis').'.'.$extension;
            $imagePath = public_path('img/profiles/'.$image_name);
            $imageServer = Image::read($image)->cover(1000, 1000, 'center')->save($imagePath);

            // return response()->json(['image' => $image_name]);
        }
        $usuario = User::find(Auth::id());
        $usuario->username = $request->username;
        $usuario->profileimage = $image_name ?? Auth::user()->profileimage ?? '';
        $usuario->save();
        return redirect()->route('posts.index', $usuario->username);
    }
}
