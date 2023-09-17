<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:list-products|create-products|edit-products|delete-products', ['only' => ['index','show']]);
        $this->middleware('permission:create-products', ['only' => ['create','store']]);
        $this->middleware('permission:edit-products', ['only' => ['edit']]);
        $this->middleware('permission:delete-products', ['only' => ['destroy']]);

    }

    public function index()
    {

        $products = Product::orderBy('id', 'DESC')->get();
        return view('products.index', compact( 'products'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(ProductRequest $request)
    {

        $validated = $request->validated();

        Product::create($validated);

        return redirect()->route('products.index')->with('message', 'Məhsul əlavə edildi.');

    }

    /**
     * Display the specified resource.
     */

    public function show(Product $ProductRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Product $product)
    {

        return view('products.edit', compact('product'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(ProductRequest $request, Product $product)
    {

        $validated = $request->validated();

        $product->update($validated);

        return redirect()->back()->with('message', 'Məhsul dəyişdirildi.');

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Product $product)
    {

        $product->delete();

        return redirect()->back()->with('message', 'Məhsul silindi.');

    }
}
