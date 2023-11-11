<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\Product;
use App\Models\Quotation;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:list-sales|create-sales|edit-sales|delete-sales', ['only' => ['index','show']]);
        $this->middleware('permission:create-sales', ['only' => ['create','store']]);
        $this->middleware('permission:edit-sales', ['only' => ['edit']]);
        $this->middleware('permission:delete-sales', ['only' => ['destroy']]);

    }

    public function index()
    {

        $sales = Sale::orderBy('id', 'DESC')->get();
        return view('sales.index', compact( 'sales'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $quotations = Quotation::all();
        $products = Product::all();
        return view('sales.create', compact('quotations','products'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {

//        dd($request->all());
        $validated = $request->validate([
            'sale_number' => 'required',
            'company' => 'required',
            'contract' => 'required',
            'quotation_id' => 'required',
            'date' => 'required',
            'tax' => 'nullable',

            'tax_fee' => 'nullable',
            'sub_total'=> 'nullable',
            'total_amount'=>'required'
        ]);

        try {
            $sale = Sale::create($validated);

            $products = $request->sale_products;
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

            $sale->products()->attach($productData);

            return redirect()->route('sales.index')->with('message', 'Satış əlavə edildi.');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());

        }
    }

    /**
     * Display the specified resource.
     */

    public function show(Sale $SaleRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {

        $sale = Sale::with('products')->findOrFail($id);
        $quotations = Quotation::all();
        $products = Product::all();
        return view('sales.edit', compact('sale' ,'quotations','products'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Sale $sale)
    {

        $validated = $request->validate([
            'sale_number' => 'required',
            'institution' => 'required',
            'contract' => 'required',
            'date' => 'required',
            'status' => 'required',
        ]);

        try {
            $sale->update($validated);

            $products = $request->sale_products;
            $productData = [];

            foreach ($products as $product) {
                $productData[$product['product_id']] = [
                    'unit' => $product['unit'],
                    'price' => $product['price'],
                    'code' => $product['code'],
                ];
            }

            $sale->products()->sync($productData);

            return redirect()->back()->with('message', 'Satış dəyişdirildi.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Sale $sale)
    {

        $sale->delete();

        return redirect()->back()->with('message', 'Satış silindi.');

    }
}
