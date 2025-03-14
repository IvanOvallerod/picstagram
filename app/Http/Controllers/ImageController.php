<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ImageController extends Controller
{
    public function store(Request $request){
        // return 'Almacenando imagen...';die;
        // dd('Imagen', request()->file('file'));
        $image = request()->file('file');
        $image_name = Str::uuid().'-'.date('YmdHis').'.'.$image->extension();
        $imagePath = public_path('img/posts/'.$image_name);
        // $imageServer = Image::read($image)->resize(1000, 1000, null, 'center')->save($imagePath);
        // $imageServer = Image::create($image)->resize(1000, 1000, null, 'center')->save($imagePath);
        $imageServer = Image::read($image)->cover(1000, 1000, 'center')->save($imagePath);

        return response()->json(['image' => $image_name]);
    }
}
