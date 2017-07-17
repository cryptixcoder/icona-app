<?php

namespace App\Http\Controllers;

use Image;
use File;
use Storage;
use App\Tow;
use App\Photo;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request, Photo $photo){
    	
    	$request->file('photo')->move(storage_path() . "/uploads", $photo->filename);

    	$file = storage_path() . "/uploads/" . $photo->filename;

        Image::make($file)->encode('jpg')->fit(500, 500, function($c){
            $c->upsize();
        })->save($file);

    	if(Storage::disk('s3')->put($photo->filename, fopen($file, 'r+'))){
    		File::delete($file);
    	}

    	return response()->json($photo, 200);
    }
}
