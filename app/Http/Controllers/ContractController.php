<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contract;

class ContractController extends Controller
{
    public function index(Request $request){

       $contracts = Contract::all();
       
       if($request->list == true){
          return response()->json([
            'contracts' => $contracts
          ]);
       }
       else{


        return view('contracts.index', [
            'contracts' => $contracts
        ]);
       }
    }

    public function create(){
        return view('contracts.create');
    }

    public function store(Request $request){
        $contract = Contract::create($request->all());

        return redirect('/contracts');
    }

    public function edit(Contract $contract){
        return view('contracts.edit', [
            'contract' => $contract
        ]);
    }

    public function update(Request $request, Contract $contract){
        $contract->update($request->all());

        return redirect('/contracts');
    }

    public function destroy(Request $request, Contract $contract){
        $contract->delete();

        return redirect('/contracts');
    }
}
