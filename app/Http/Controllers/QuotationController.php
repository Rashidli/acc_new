<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\Product;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuotationController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:list-quotations|create-quotations|edit-quotations|delete-quotations', ['only' => ['index','show']]);
        $this->middleware('permission:create-quotations', ['only' => ['create','store']]);
        $this->middleware('permission:edit-quotations', ['only' => ['edit']]);
        $this->middleware('permission:delete-quotations', ['only' => ['destroy']]);

    }

    public function index()
    {

        $quotations = Quotation::orderBy('id', 'DESC')->get();
        return view('quotations.index', compact( 'quotations'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ins = Institution::all();
        $products = Product::all();
        return view('quotations.create', compact('ins','products'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {


        $validated = $request->validate([
            'quotation_number' => 'required',
            'institution' => 'required',
            'contract' => 'required',
            'date' => 'required',
        ]);

        try {
            $quotation = Quotation::create($validated);

            $products = $request->quotation_products;
            $productData = [];

            foreach ($products as $product) {
                $productData[$product['product_id']] = [
                    'unit' => $product['unit'],
                    'code' => $product['code'],
                    'price' => $product['price'],
                ];
            }

            $quotation->products()->attach($productData);

            return redirect()->route('quotations.index')->with('message', 'Quotation əlavə edildi.');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());

        }
    }

    /**
     * Display the specified resource.
     */

    public function show(Quotation $QuotationRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {
        $quotation = Quotation::with('products')->findOrFail($id);
        $ins = Institution::all();
        $products = Product::all();
        return view('quotations.edit', compact('quotation' ,'ins','products'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Quotation $quotation)
    {

        $validated = $request->validate([
            'quotation_number' => 'required',
            'institution' => 'required',
            'contract' => 'required',
            'date' => 'required',
            'status' => 'required',
        ]);

        try {
            $quotation->update($validated);

            $products = $request->quotation_products;
            $productData = [];

            foreach ($products as $product) {
                $productData[$product['product_id']] = [
                    'unit' => $product['unit'],
                    'price' => $product['price'],
                    'code' => $product['code'],
                ];
            }

            $quotation->products()->sync($productData);

            return redirect()->back()->with('message', 'Quotation dəyişdirildi.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Quotation $quotation)
    {

        $quotation->delete();

        return redirect()->back()->with('message', 'Quotation silindi.');

    }
}
