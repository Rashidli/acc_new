<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BankPayment;
use App\Models\Plan;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class BankPaymentController extends Controller
{

    public function __construct()
    {

        $this->middleware('permission:list-bank_payments|create-bank_payments|edit-bank_payments|delete-bank_payments', ['only' => ['index','show']]);
        $this->middleware('permission:create-bank_payments', ['only' => ['create','store']]);
        $this->middleware('permission:edit-bank_payments', ['only' => ['edit']]);
        $this->middleware('permission:delete-bank_payments', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {

        $purchases = Purchase::all();
        $banks  = Bank::all();
        $debet_credits = Plan::all();
        $bank_payments = BankPayment::orderBy('id', 'DESC')->get();

        return view('bank_payments.index', compact('bank_payments','debet_credits','purchases','banks'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {

        if ($request->has('bank_payments')) {
            foreach ($request->bank_payments as $value) {
                $data = [
                    'electron_invoice' => $value['electron_invoice'],
                    'debet' => $value['debet'],
                    'credit' => $value['credit'],
                    'company' => $value['company'],
                    'date' => $value['date'],
                    'payment_type' => $value['payment_type'],
                    'payment_amount' => $value['payment_amount'],
                    'bank' => $value['bank'],
                    'purchase_id' => $value['purchase_id'],
                ];

                $bankPayment = BankPayment::find($value['id']);

                if ($bankPayment) {
                    $bankPayment->update($data);
                } else {
                    BankPayment::create($data);
                }
            }
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(BankPayment $bankPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BankPayment $bankPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BankPayment $bankPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BankPayment $bankPayment)
    {
        //
    }
}
