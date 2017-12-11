<?php

namespace App\Http\Controllers;

use App\Tow;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request){

    	$term = $request->term;
    	$by = $request->by;

    	if($by == "tow_number"){
    		$tows = Tow::parents()->lastUpdated()->where('tow_number', $term)->get();
    	}
    	elseif($by == "tags"){
    		$tows = Tow::parents()->lastUpdated()->where('tags', 'like', '%' . $term . '%')->get();
    	}
        elseif($by == "vin"){
            $tows = Tow::parents()->lastUpdated()->where('vin', 'like', '%' . $term . '%')->get();
        }  	

    	return view('search', [
    		'tows' => $tows
    	]);

    }
}
