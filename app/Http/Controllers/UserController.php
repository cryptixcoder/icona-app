<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(){

        $users = User::paginate(10);

        return view('users.index',[
            'users' => $users
        ]);
    }

    public function show(User $user){
        return view('users.show',[
            'user' => $user
        ]);
    }

    public function create(){
        return view('users.create', [
            'types' => collect([
                [
                    'label' => 'Administrator',
                    'name' => 'admin'
                ],
                [
                    'label' => 'Driver',
                    'name' => 'driver'
                ]
            ])
        ]);
    }

    public function store(Request $request){

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => $request->type
        ]);

        return redirect('/users')
                    ->withSuccess('User account created.');

    }

    public function edit(User $user){
        return view('users.edit', [
            'user' => $user,
            'types' => collect([
                [
                    'label' => 'Administrator',
                    'name' => 'admin'
                ],
                [
                    'label' => 'Driver',
                    'name' => 'driver'
                ]
            ])
        ]);
    }

    public function update(Request $request, User $user){

        $payload = [
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => $request->type
        ];

        if($request->has('password')){
            $payload['password'] = bcrypt($request->password);
        }

        $user->update($payload);

        return redirect()
                    ->back()
                    ->withSuccess('User account created.');
    }

    public function destroy(Request $request){
        $user->delete();

        return redirect('/users')
                ->withSuccess('User has been removed.');
    }
}
