<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tow;
use App\Contract;

class TowController extends Controller
{
    public function index(){
        $tows = Tow::all();

        return view('tows.index', [
            'tows' => $tows
        ]);
    }

    public function show(Tow $tow){
        return response()->json($tow);
    }

    public function store(Request $request){
        $user = $request->user();

        $contract = null;
        $prefix = "000";


        if($request->contract_id){
            $contract = Contract::find($request->contract_id);
            $prefix = $contract->prefix;
        }

        $tow = $user->tows()->create([
            'contract_id' => $request->contract_id,
            'tow_number' => $prefix . "-" . (Tow::count() + 1)
        ]);

        return response()->json([
            'tow_id' => $tow->id
        ]);
    }

    public function edit(Tow $tow){
        return view('tows.edit', [
            'tow' => $tow
        ]);
    }

    public function update(Request $request, Tow $tow){

        $tow->update([
            'make' => $request->make,
            'model' => $request->model,
            'year' => $request->year,
            'vehicle_color' => $request->vehicle_color
        ]);

        return response()->json(null, 200);

    }

    public function destroy(Request $request){
        $tow->delete();

        return redirect('/tows');
    }
}
