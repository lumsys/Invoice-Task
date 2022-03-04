<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Invoice;
use Auth;
use DB;

class InvoiceController extends Controller
{
    //

    public function storeInvoices(Request $request)
    {
         $latest = Invoice::latest()->first();

    if (! $latest) {
        $string = 0;
    }

    $string = $latest->invoice_number +1;
   // $string = preg_replace("/[^0-9\.]/", '', $latest->invoice_number);

         $current = \Carbon\Carbon::now();
         $input['unique_id'] = $request->tag.'/'.str_pad((int) 4, '0', STR_PAD_LEFT);
         $input['issue_date'] = Carbon::now();
         $input['due_days'] = $request->due_days;
         $input['due_date'] = $current->addDays($request->due_days);
         $input['reference'] = $request->reference;
         $input['user_id'] = Auth::id();
         $input['invoice_number'] = $string;
         $input['description'] =  $request->description;
         $input['qty'] =  $request->qty;
         $input['amount'] =  $request->amount;
         $input['vat'] = $request->amount*10/2;

        $invoice = new \App\Invoice($input);
        $invoice->save();
        return response()->json(["status" => "success", $invoice ], 200);
    }

    public function getInvoices()
    {
        $invoices = Invoice::where('user_id', Auth::id())->get();
        return response()->json($invoices);
    }


    public function count()
    {
        $invoices = Invoice::where('user_id', Auth::id())->count();
        return response()->json(["status" => "success", $invoices], 200);
    }


    public function sum_invoice()
    {
    //     DB::table('invoices')
    // ->select('vat', 'amount', DB::raw('SUM(amount) AS Total_Amount'))
    // ->get();
    $data=Invoice::where('user_id','=',Auth::id())->sum('amount');

    return response()->json(["status" => "success",'total'=> $data], 200);


    }





}
