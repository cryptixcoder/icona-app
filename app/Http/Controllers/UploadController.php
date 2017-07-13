<?php

namespace App\Http\Controllers;

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

    	$s3Url = Storage::disk('s3')->put($photo->filename, fopen($file, 'r+'));

    	File::delete($file);

    	return response()->json($photo, 200);
    }
}
