<?php

namespace App\Http\Controllers;

use Image;
use File;
use Storage;
use App\Tow;
use App\Photo;
use App\Jobs\UploadImage;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request, Photo $photo){
    	
    	$request->file('photo')->move(storage_path() . "/uploads", $photo->filename);

        $this->dispatch(new UploadImage($photo));

    	return response()->json($photo, 200);
    }
}
