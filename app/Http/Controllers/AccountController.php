<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(){
    	return view('account.index', [
    		'user' => request()->user()
    	]);
    }

    public function update(Request $request){

    	$this->validate($request, [
    		'email' => 'required'
    	]);

    	$user = $request->user();

        $payload = [
            'name'  => $request->name,
            'email' => $request->email
        ];

        if($request->has('password')){
            $payload['password'] => bcrypt($request->password)
        }

    	$user->update($payload);

    	return back()->with('success', 'Your account information has been updated!');

    }
}
