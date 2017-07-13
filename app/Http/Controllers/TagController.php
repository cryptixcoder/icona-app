<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    public function index(){
        $tags = Tag::all();
    	
        if(request()->ajax()){
            return $tags;
        }

        return view('tags.index',[
            'tags' => $tags
        ]);

    }

    public function show(){
        return response()->json([
            'tags' => Tag::all()
        ]);
    }

    public function create(){
        return view('tags.create');
    }

    public function store(Request $request){
    	Tag::create($request->all());

    	return redirect('/tags');
    }

    public function edit(Tag $tag){
        return view('tags.edit', [
            'tag' => $tag
        ]);
    }

    public function update(Request $request, Tag $tag){
    	$tag->update($request->all());

    	return response()->json(null, 200);
    }

    public function destroy(Request $request, Tag $tag){
    	$tag->delete();

    	return redirect()->back();
    }
}
