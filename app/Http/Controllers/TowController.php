<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use App\PrivateTowSettings;
use App\Tow;
use App\Contract;

class TowController extends Controller
{
    public function index(Request $request){

        if($request->has('contract')){  
            
            if($request->contract === 'private'){
                if(request()->user()->user_type == "driver"){
                    $tows = request()
                            ->user()
                            ->tows()
                            ->parents()
                            ->active()
                            ->private()
                            ->lastUpdated()
                            ->paginate(10);
                }
                else{
                    $tows = Tow::parents()
                            ->active()
                            ->private()
                            ->lastUpdated()
                            ->paginate(10);
                }

                return view('tows.private', [
                    'tows' => $tows
                ]);
            }
            else{
                $contract = Contract::findOrFail($request->contract);
                
                if(request()->user()->user_type == "driver"){
                    $tows = request()
                            ->user()
                            ->tows()
                            ->parents()
                            ->active()
                            ->contract($request->contract)
                            ->lastUpdated()
                            ->paginate(10);
                }
                else{
                    $tows = Tow::parents()
                            ->active()
                            ->contract($request->contract)
                            ->lastUpdated()
                            ->paginate(10);
                }

                return view('tows.contract', [
                    'tows' => $tows,
                    'contract' => $contract
                ]);
            }
        }
        else{
            if(request()->user()->user_type == "driver"){
                $tows = request()
                        ->user()
                        ->tows()
                        ->parents()
                        ->active()
                        ->lastUpdated()
                        ->paginate(10);
            }
            else{
                $tows = Tow::parents()
                        ->active()
                        ->lastUpdated()
                        ->paginate(10);
            }
    
    
            return view('tows.index', [
                'tows' => $tows
            ]);
        }
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

    public function viewPrintableContracts(Request $request){
        if($request->has('contract')){  
            if($request->contract == "private"){
                
                if(request()->user()->user_type == "driver"){
                    $tows = request()
                            ->user()
                            ->tows()
                            ->parents()
                            ->active()
                            ->private()
                            ->lastUpdated()
                            ->get();
                }
                else{
                    $tows = Tow::parents()
                            ->active()
                            ->private()
                            ->lastUpdated()
                            ->get();
                }
    
                return view('tows.privateselectablecontract', [
                    'tows' => $tows
                ]);
            }
            else{
                $contract = Contract::findOrFail($request->contract);
                
                if(request()->user()->user_type == "driver"){
                    $tows = request()
                            ->user()
                            ->tows()
                            ->parents()
                            ->active()
                            ->contract($request->contract)
                            ->lastUpdated()
                            ->get();
                }
                else{
                    $tows = Tow::parents()
                            ->active()
                            ->contract($request->contract)
                            ->lastUpdated()
                            ->get();
                }
    
                return view('tows.selectablecontract', [
                    'tows' => $tows,
                    'contract' => $contract
                ]);
            }
        }
        else{
            abort(404);
        }
    }

    public function renderPrintableContracts(Request $request){
       $tows = Tow::find($request->tows);

       return view('tows.printall', [
            'tows' => $tows
       ]);
    }

    public function store(Request $request){
        $user = $request->user();

        $contract = null;
        $prefix = "P";
        $count = 0;
        $privateStartCount = 3961;

        if($request->contract_id){
            $contract = Contract::find($request->contract_id);
            $contractCount = $contract->tow_start_count;
            
            $contract->update([
                'tow_start_count' => $contractCount + 1
            ]);

            $prefix = $contract->prefix;

            $count = $contractCount;
        
        }
        else{
            $private = PrivateTowSettings::first();
            $privateCount = $private->count;

            $private->update([
                'count' => $privateCount + 1
            ]);

            $count = $privateCount;

            //$count = (Tow::parents()->where('tow_number', 'like', 'P-%')->count() + 1);
        }


        $tow = $user->tows()->create([
            'contract_id' => $request->contract_id,
            'tow_number' => $prefix . "-" . sprintf('%04d', $count),
            'latitude' => ($request->latitude) ? $request->latitude : null,
            'longitude' => ($request->longitude) ? $request->longitude : null,
            'state' => "PA"
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
            'tag_number' => strtoupper($request->tag_number),
            'vin' => strtoupper($request->vin),
            'mileage' => $request->mileage,
            'officer_id' => $request->officer_id,
            'complaint_id' => $request->complaint_id,
            'lot_id' => $request->lot_id,
            'phone' => $request->phone,
            'vehicle_owner' => $request->vehicle_owner,
            'location' => $request->location,
            'lot_id' => $request->lot_id,
            'reason_id' => $request->reason_id,
            'tags' => ($request->tags) ? implode(",",$request->tags) : "",
            "notes" => $request->notes
        ]);

        return response()->json([], 200);

    }

    public function add_child(Request $request, Tow $tow){

        $child = $tow->children()->create([
            'user_id' => $tow->user_id,
            'officer_id' => $tow->officer_id,
            'complaint_id' => $tow->complaint_id,
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
