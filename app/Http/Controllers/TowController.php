<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use App\Tow;
use App\Contract;

class TowController extends Controller
{
    public function index(){
        
        if(request()->user()->user_type == "driver"){
            $tows = request()->user()->tows()->parents()->active()->paginate(10);
        }
        else{
            $tows = Tow::parents()
                    ->active()
                    ->paginate(10);
        }


        return view('tows.index', [
            'tows' => $tows
        ]);
    }

    public function show(Request $request, Tow $tow){
        $tow->load(['children','photos']);
        
        if(request()->ajax()){
            return response()->json($tow);
        }
        else{
            if($request->has('download')){
                $pdf = App::make('dompdf.wrapper');
                $pdf->loadView('tows.show', [
                    'tow' => $tow
                ]);
        
                return $pdf->download($tow->tow_number . ".pdf");
            }
            elseif($request->has('viewphotos')){
                return view('tows.photos', [
                    'tow' => $tow
                ]);
            }
            else{
                return view('tows.show', [
                    'tow' => $tow
                ]);
            }
        }
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
            'tow_number' => $prefix . "-" . (Tow::count() + 1),
            'latitude' => ($request->latitude) ? $request->latitude : null,
            'longitude' => ($request->longitude) ? $request->longitude : null
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
            'vehicle_color' => $request->vehicle_color,
            'state' => $request->state,
            'tag_number' => $request->tag_number,
            'vin' => $request->vin,
            'mileage' => $request->mileage,
            'officer_id' => $request->officer_id,
            'complaint_number' => $request->complaint_number,
            'lot_id' => $request->lot_id,
            'phone' => $request->phone,
            'vehicle_owner' => $request->vehicle_owner,
            'location' => $request->location,
            'lot_id' => $request->lot_id,
            'reason_id' => $request->reason_id,
            'tags' => ($request->tags) ? implode(",",$request->tags) : ""
        ]);

        return response()->json([], 200);

    }

    public function add_child(Request $request, Tow $tow){

        $child = $tow->children()->create([
            'user_id' => $tow->user_id,
            'officer_id' => $tow->officer_id,
            'complaint_number' => $tow->complaint_number,
            'vehicle_owner' => $tow->vehicle_owner,
            'tow_number' => $tow->tow_number . '-' . ($tow->children()->count() + 1),
            'location' => $tow->location,
            'latitude' => $tow->latitude,
            'longitude' => $tow->longitude
        ]);


        return response()->json($child, 200);

    }

    public function destroy(Request $request, Tow $tow){
        $tow->delete();

        if($request->ajax()){
            return response(null, 200);
        }
        else{
            return redirect('/tows');
        }
    }

    public function tow_validator(Request $request, Tow $tow){
        return response()->json([
            'tow_validated' => $tow->photos()->count() >= 5
        ]);
    }

    public function archive(Request $request, Tow $tow){

        $archive = false;

        if(!$tow->archived){
            $archive = true;
        }

        $tow->update([
            'archived' => $archive
        ]);

        return response()->json([
            'archived' => $archive
        ]);

    }

    public function release(Request $request, Tow $tow){

        $release = false;

        if(!$tow->released){
            $release = true;
        }

        $tow->update([
            'released' => $release
        ]);

        return response()->json([
            'released' => $release
        ]);

    }
}
