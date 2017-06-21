<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(){
        $invoices = Invoice::all();
        return view('invoices.index',[
            'invoices' => $invoices
        ]);
    }

    public function show(Invoice $invoice){
        return view('invoices.show', [
            'invoice' => $invoice
        ]);
    }

    public function create(){
        return view('invoices.create');
    }

    public function store(Request $request){

    }

    public function edit(){

    }

    public function update(Request $request){

    }

    public function destroy(Request $request){

    }
}
