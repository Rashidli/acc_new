<?php

namespace App\Http\Controllers;

use App\Http\Requests\WarehouseRequest;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:list-warehouses|create-warehouses|edit-warehouses|delete-warehouses', ['only' => ['index','show']]);
        $this->middleware('permission:create-warehouses', ['only' => ['create','store']]);
        $this->middleware('permission:edit-warehouses', ['only' => ['edit']]);
        $this->middleware('permission:delete-warehouses', ['only' => ['destroy']]);

    }

    public function index()
    {

        $warehouses = Warehouse::orderBy('id', 'DESC')->get();
        return view('warehouses.index', compact( 'warehouses'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('warehouses.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(WarehouseRequest $request)
    {

        $validated = $request->validated();

        Warehouse::create($validated);

        return redirect()->route('warehouses.index')->with('message', 'Anbar əlavə edildi.');

    }

    /**
     * Display the specified resource.
     */

    public function show(Warehouse $WarehouseRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Warehouse $warehouse)
    {

        return view('warehouses.edit', compact('warehouse'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(WarehouseRequest $request, Warehouse $warehouse)
    {

        $validated = $request->validated();

        $warehouse->update($validated);

        return redirect()->back()->with('message', 'Anbar dəyişdirildi.');

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Warehouse $warehouse)
    {

        $warehouse->delete();

        return redirect()->back()->with('message', 'Anbar silindi.');

    }
}
