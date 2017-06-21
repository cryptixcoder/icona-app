<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lot;

class LotController extends Controller
{
    public function index(){
        $lots = Lot::all();

    	return view('lots.index', [
            'lots' => $lots
        ]);
    }

    public function create(){
        return view('lots.create');
    }

    public function store(Request $request){

    	$this->validate($request, [
    		'name' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
    	]);

    	$lot = Lot::create($request->all());

    	return redirect('/lots');

    }

    public function edit(Lot $lot){
        return view('lots.edit', [
            'lot' => $lot
        ]);
    }

    public function update(Request $request, Lot $lot){
    	$this->validate($request, [
    		'name' => 'required'
    	]);

    	$lot->update($request->all());

    	return redirect('/lots');
    }

    public function destroy(Lot $lot){
    	$lot->delete();

    	return response()->json([], 200);
    }
}
