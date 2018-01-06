<?php

namespace App\Http\Controllers;

use App\User;
use App\Tow;
use App\Contract;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = $request->user();

        if($user->user_type == 'driver'){

            $tows = $user->tows()
                         ->parents()
                         ->active()
                         ->lastUpdated()
                         ->paginate(10);

            return view('tows.index', [
                'tows' => $tows
            ]);

        }
        else{
            $drivers = count(User::type('driver')->get()->toArray());
            $tows = count(Tow::active()->get()->toArray());
            $contracts = count(Contract::all()->toArray());
            $admins = count(User::type('admin')->get()->toArray());

            return view('home',[
                'drivers' => $drivers,
                'tows' => $tows,
                'contracts' => $contracts,
                'admins' => $admins                
            ]);
        }
    }
    
}
