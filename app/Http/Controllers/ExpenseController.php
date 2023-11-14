<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use App\Models\Institution;
use App\Models\Sale;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:list-expenses|create-expenses|edit-expenses|delete-expenses', ['only' => ['index','show']]);
        $this->middleware('permission:create-expenses', ['only' => ['create','store']]);
        $this->middleware('permission:edit-expenses', ['only' => ['edit']]);
        $this->middleware('permission:delete-expenses', ['only' => ['destroy']]);

    }

    public function index()
    {

        $expenses = Expense::orderBy('id', 'DESC')->get();
        return view('expenses.index', compact( 'expenses'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $wares = Warehouse::all();
        $sale_orders = Sale::where('status', Status::APPROVED)->get();
        return view('expenses.create', compact('sale_orders','wares'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {

        DB::beginTransaction();

        try {

            $request->validate([
                'date' => 'required',
                'company' => 'required',
                'warehouse_name' => 'required',
            ]);

            $expense = new Expense();



            $expense->date = $request->date;
            $expense->company = $request->company;
            $expense->warehouse_name = $request->warehouse_name;

            $number = DB::table('expenses')->max('id');

            $expense_number = 'AC' .  substr( date("y"), -2). '-' . '0000' . $number + 1;

            $expense->expense_number = $expense_number;
            $expense->save();


            $products = $request->expense_products;
            $productData = [];

            foreach ($products as $product) {
                $productData[$product['product_id']] = [
                    'unit' => $product['unit'],
                    'code' => $product['code'],
                    'quantity' => $product['quantity'],
                ];
            }

            $expense->products()->attach($productData);


            DB::commit();
            return redirect()->route('expenses.index')->with('message', 'Məxaric əlavə edildi.');
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }

    }

    /**
     * Display the specified resource.
     */

    public function show(Expense $ExpenseRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Expense $expense)
    {

        $sale_orders = Sale::where('status', Status::APPROVED)->get();
        $products = Sale::with('products')->findOrFail($expense->sale_id)->products;

        $wares = Warehouse::all();
        return view('expenses.edit', compact('expense','products' ,'sale_orders','wares'));

    }


    /**
     * Update the specified resource in storage.
     */

    public function update(ExpenseRequest $request, Expense $expense)
    {

        DB::beginTransaction();
        try {

            $validated = $request->validated();
            $expense->update($validated);

            $products = $request->expense_products;
            $productData = [];

            foreach ($products as $product) {
                $productData[$product['product_id']] = [
                    'unit' => $product['unit'],
                    'code' => $product['code'],
                    'quantity' => $product['quantity'],
                ];
            }

            $expense->products()->sync($productData);

            DB::commit();
            return redirect()->back()->with('message', 'Məxaric dəyişdirildi.');
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Expense $expense)
    {

        $expense->delete();

        return redirect()->back()->with('message', 'Məxaric silindi.');

    }
}
