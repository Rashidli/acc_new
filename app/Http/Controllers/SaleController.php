<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Institution;
use App\Models\Product;
use App\Models\Quotation;
use App\Models\Sale;
use Illuminate\Http\Request;
use function Termwind\renderUsing;

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

        $quotations = Quotation::where('status', Status::APPROVED)->get();
        $products = Product::all();
        return view('sales.create', compact('quotations','products'));

    }

    public function getProducts(Request $request)
    {

        try {
            $quotation = Quotation::with('products')->where('status', Status::APPROVED)->findOrFail($request->id);

            $products = $quotation->products;

            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Quotation not found'], 404);
        }
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
        $products = Quotation::with('products')->findOrFail($sale->quotation_id)->products;
        $quotations = Quotation::all();

        return view('sales.edit', compact('sale' ,'quotations','products'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Sale $sale)
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
            'total_amount'=>'required',
            'status'=>'required',
        ]);

        try {
            $sale->update($validated);

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
