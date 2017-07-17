<?php

namespace App\Http\Controllers;

use App\Reason;
use Illuminate\Http\Request;

class ReasonController extends Controller
{
    public function index(){
        $reasons = Reason::all();
    	
        if(request()->ajax()){
            return $reasons;
        }

        return view('reasons.index',[
            'reasons' => $reasons
        ]);

    }

    public function show(Reason $reason){
        return response()->json([
            'reason' => $reason
        ]);
    }

    public function create(){
        return view('reasons.create');
    }

    public function store(Request $request){
    	Reason::create($request->all());

    	return redirect('/reasons');
    }

    public function edit(Reason $reason){
        return view('reasons.edit', [
            'reason' => $reason
        ]);
    }

    public function update(Request $request, Reason $reason){
    	$reason->update($request->all());

    	return redirect('/reasons');
    }
}
