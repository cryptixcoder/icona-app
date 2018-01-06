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
            $drivers = User::type('driver')->count();
            $tows = Tow::active()->count();
            $contracts = Contract::count();
            $admins = User::type('admin')->count();

            return view('home',[
                'drivers' => $drivers,
                'tows' => $tows,
                'contracts' => $contracts,
                'admins' => $admins                
            ]);
        }
    }
    
}
