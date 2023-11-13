<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use App\Models\Institution;
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
        $ins = Institution::all();
        $wares = Warehouse::all();
        return view('expenses.create', compact('ins','wares'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {


        try {
            $expense = new Expense();

            $request->validate([
                'date' => 'required',
                'company' => 'required',
                'warehouse_name' => 'required',
            ]);

            $expense->date = $request->date;
            $expense->company = $request->company;
            $expense->warehouse_name = $request->warehouse_name;

            $number = DB::table('expenses')->max('id');

            $expense_number = 'AC' .  substr( date("y"), -2). '-' . '0000' . $number + 1;

            $expense->expense_number = $expense_number;
            $expense->save();

            if($request->orderProducts ){
                foreach ($request->orderProducts as $product){
                    $expense->products()->attach($product['product_id'], ['quantity'=>$product['measure']]);
                }
            }
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

        $ins = Institution::all();
        $wares = Warehouse::all();
        return view('expenses.edit', compact('expense' ,'ins','wares'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(ExpenseRequest $request, Expense $expense)
    {

        try {
            $validated = $request->validated();

            if ($request->orderProducts) {
                $expense->products()->sync([]);
                foreach ($request->orderProducts as $product) {
                    $expense->products()->attach($product['product_id'], ['quantity' => $product['measure']]);
                }
            }

            $expense->update($validated);
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
