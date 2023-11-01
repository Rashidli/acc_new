<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Models\Income;
use App\Models\Plan;
use App\Models\Purchase;
use App\Models\Institution;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:list-purchases|create-purchases|edit-purchases|delete-purchases', ['only' => ['index','show']]);
        $this->middleware('permission:create-purchases', ['only' => ['create','store']]);
        $this->middleware('permission:edit-purchases', ['only' => ['edit']]);
        $this->middleware('permission:delete-purchases', ['only' => ['destroy']]);

    }

    public function index()
    {

        $purchases = Purchase::orderBy('id', 'DESC')->get();
//        dd($purchases);
        return view('purchases.index', compact( 'purchases'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ins = Institution::all();
        $wares = Income::with('products')->get();
        $debet_credits = Plan::all();
        return view('purchases.create', compact('ins','wares','debet_credits'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {


            $purchase = new Purchase();

            $request->validate([
                'date' => 'required',
                'company' => 'required',
                'electron_invoice' => 'required|unique:purchases',
                'debet' => 'required',
                'credit' => 'required',
                'income_number' => 'required',
            ]);

            DB::beginTransaction();

        try {

            $purchase->date = $request->date;
            $purchase->company = $request->company;
            $purchase->income_number = $request->income_number;
            $purchase->electron_invoice = $request->electron_invoice;
            $purchase->debet = $request->debet;
            $purchase->credit = $request->credit;
            if($request->common_price){
                $purchase->total_amount = $request->common_price;
            }else{
                $purchase->total_amount = $request->test_price;
            }

            $number = DB::table('purchases')->max('id');

            $purchase_number = 'WR' .  substr( date("y"), -2). '-' . '0000' . $number + 1;

            $purchase->purchase_number = $purchase_number;
            $purchase->save();

            if($request->orderProducts ){
                foreach ($request->orderProducts as $product){
                    $purchase->products()->attach($product['product_id'], ['quantity'=>$product['measure'], 'unit'=>$product['unit'], 'edv'=>$product['edv'], 'price'=>$product['price'], 'total_amount'=>$product['total_amount']]);
                }
            }
            DB::commit();
            return redirect()->route('purchases.index')->with('message', 'Alış əlavə edildi.');
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }

    }

    /**
     * Display the specified resource.
     */

    public function show(Purchase $PurchaseRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {
        $purchase = Purchase::with('products')->findOrFail($id);
        $ins = Institution::all();
        $wares = Income::all();
        $debet_credits = Plan::all();
        return view('purchases.edit', compact('purchase' ,'ins','wares','debet_credits'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Purchase $purchase)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'date' => 'required',
                'company' => 'required',
                'electron_invoice' => 'required|unique:purchases'. $purchase,
                'debet' => 'required',
                'credit' => 'required',
                'income_number' => 'required',
            ]);

            $purchase->date = $request->date;
            $purchase->company = $request->company;
            $purchase->income_number = $request->income_number;
            $purchase->electron_invoice = $request->electron_invoice;
            $purchase->debet = $request->debet;
            $purchase->credit = $request->credit;
            if($request->common_price){
                $purchase->total_amount = $request->common_price;
            }else{
                $purchase->total_amount = $request->test_price;
            }

            $purchase->save();

            if ($request->orderProducts) {
                $purchase->products()->sync([]);
                foreach ($request->orderProducts as $product) {
                    $purchase->products()->attach($product['product_id'], ['quantity'=>$product['measure'], 'unit'=>$product['unit'], 'edv'=>$product['edv'], 'price'=>$product['price'], 'total_amount'=>$product['total_amount']]);
                }
            }

            DB::commit();
            return redirect()->back()->with('message', 'Alış dəyişdirildi.');
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Purchase $purchase)
    {

        $purchase->delete();

        return redirect()->back()->with('message', 'Alış silindi.');

    }
}
