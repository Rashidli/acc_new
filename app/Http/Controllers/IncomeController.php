<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncomeRequest;
use App\Models\Income;
use App\Models\Institution;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class IncomeController extends Controller
{


    public function __construct()
    {

        $this->middleware('permission:list-incomes|create-incomes|edit-incomes|delete-incomes', ['only' => ['index','show']]);
        $this->middleware('permission:create-incomes', ['only' => ['create','store']]);
        $this->middleware('permission:edit-incomes', ['only' => ['edit']]);
        $this->middleware('permission:delete-incomes', ['only' => ['destroy']]);

    }

    public function index()
    {

        $incomes = Income::orderBy('id', 'DESC')->get();
        return view('incomes.index', compact( 'incomes'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {

        $ins = Institution::all();
        $wares = Warehouse::all();
        return view('incomes.create', compact('ins','wares'));

    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $income = new Income();

            $request->validate([
                'date' => 'required',
                'company' => 'required',
                'warehouse_name' => 'required',
            ]);

            $income->date = $request->date;
            $income->company = $request->company;
            $income->warehouse_name = $request->warehouse_name;

            $number = DB::table('incomes')->max('id');

            $income_number = 'AA' .  substr( date("y"), -2). '-' . '0000' . $number + 1;

            $income->income_number = $income_number;
            $income->save();

            if($request->orderProducts ){
                foreach ($request->orderProducts as $product){
                    $income->products()->attach($product['product_id'], ['quantity'=>$product['measure']]);
                }
            }
            DB::commit();
            return redirect()->route('incomes.index')->with('message', 'Mədaxil əlavə edildi.');
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }

    }

    /**
     * Display the specified resource.
     */

    public function show(Income $IncomeRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Income $income)
    {

        $ins = Institution::all();
        $wares = Warehouse::all();
        return view('incomes.edit', compact('income' ,'ins','wares'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(IncomeRequest $request, Income $income)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validated();
            $income->update($validated);

            if ($request->orderProducts) {
                $productData = [];

                foreach ($request->orderProducts as $product) {
                    $productData[$product['product_id']] = ['quantity' => $product['measure']];
                }

                $income->products()->sync($productData);
            }

            DB::commit();
            return redirect()->back()->with('message', 'Mədaxil dəyişdirildi.');
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Income $income)
    {

        $income->delete();

        return redirect()->back()->with('message', 'Mədaxil silindi.');

    }
}
