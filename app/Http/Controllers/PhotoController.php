<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Tow;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function show(Photo $photo){
    	return response()->json($photo);
    }	

    public function store(Request $request, Tow $tow){
    	$uid = uniqid(true);

    	$photo = $tow->photos()->create([
    		"filename" => "{$uid}.{$request->extension}"
    	]);

    	return response()->json($photo, 200);
    }

    public function update(Request $request, Photo $photo){

    	$photo->update([
    		'notes' => $request->notes
    	]);

    	return response()->json([], 200);

    }
}
