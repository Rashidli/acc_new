<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Quotation;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:list-invoices|create-invoices|edit-invoices|delete-invoices', ['only' => ['index','show']]);
        $this->middleware('permission:create-invoices', ['only' => ['create','store']]);
        $this->middleware('permission:edit-invoices', ['only' => ['edit']]);
        $this->middleware('permission:delete-invoices', ['only' => ['destroy']]);

    }

    public function index()
    {

        $invoices = Invoice::orderBy('id', 'DESC')->get();
        return view('invoices.index', compact( 'invoices'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {

        $sales = Sale::where('status', Status::APPROVED)->get();
        $products = Product::all();
        return view('invoices.create', compact('sales','products'));

    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $invoice = new Invoice();

            $request->validate([
                'company' => 'required',
                'sale_id' => 'required',
                'date' => 'required',
                'e_invoice' => 'required',
                'debet' => 'required',
                'credit' => 'required',

                'tax_fee' => 'nullable',
                'sub_total'=> 'nullable',
                'total_amount'=>'required'
            ]);

            $invoice->company = $request->company;
            $invoice->sale_id = $request->sale_id;
            $invoice->date = $request->date;
            $invoice->e_invoice = $request->e_invoice;
            $invoice->debet = $request->debet;
            $invoice->credit = $request->credit;
            $invoice->tax_fee = $request->tax_fee;
            $invoice->sub_total = $request->sub_total;
            $invoice->total_amount = $request->total_amount;

            $number = DB::table('invoices')->max('id');

            $invoice_number = 'AA' .  substr( date("y"), -2). '-' . '0000' . $number + 1;

            $invoice->invoice_number = $invoice_number;
            $invoice->save();

            $products = $request->invoice_products;
            $productData = [];

            foreach ($products as $product) {
                $productData[$product['product_id']] = [
                    'unit' => $product['unit'],
                    'code' => $product['code'],
                    'price' => $product['price'],
                    'quantity' => $product['quantity'],
                    'sub_total' => $product['sub_total'],
                ];
            }

            $invoice->products()->attach($productData);
            DB::commit();
            return redirect()->route('invoices.index')->with('message', 'Invoice əlavə edildi.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());

        }

    }

    /**
     * Display the specified resource.
     */

    public function show(Invoice $InvoiceRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {

        $invoice = Invoice::with('products')->findOrFail($id);

        $products = Sale::with('products')->findOrFail($invoice->quotation_id)->products;

        return view('invoices.edit', compact('invoice' ,'products'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Invoice $invoice)
    {


        $validated = $request->validate([
            'company' => 'required',
            'sale_id' => 'required',
            'date' => 'required',
            'e_invoice' => 'required',
            'debet' => 'required',
            'credit' => 'required',

            'tax_fee' => 'nullable',
            'sub_total'=> 'nullable',
            'total_amount'=>'required'
        ]);

        DB::beginTransaction();
        try {
            $invoice->update($validated);

            $products = $request->invoice_products;
            $productData = [];

            foreach ($products as $product) {
                $productData[$product['product_id']] = [
                    'unit' => $product['unit'],
                    'code' => $product['code'],
                    'price' => $product['price'],
                    'quantity' => $product['quantity'],
                    'sub_total' => $product['sub_total'],
                ];
            }

            $invoice->products()->sync($productData);
            DB::commit();
            return redirect()->back()->with('message', 'Invoice dəyişdirildi.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Invoice $invoice)
    {

        $invoice->delete();

        return redirect()->back()->with('message', 'Invoice silindi.');

    }
}
