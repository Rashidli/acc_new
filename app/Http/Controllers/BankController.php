<?php

namespace App\Http\Controllers;

use App\Http\Requests\BankRequest;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:list-banks|create-banks|edit-banks|delete-banks', ['only' => ['index','show']]);
        $this->middleware('permission:create-banks', ['only' => ['create','store']]);
        $this->middleware('permission:edit-banks', ['only' => ['edit']]);
        $this->middleware('permission:delete-banks', ['only' => ['destroy']]);

    }

    public function index()
    {

        $banks = Bank::orderBy('id', 'DESC')->get();
        return view('banks.index', compact( 'banks'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('banks.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(BankRequest $request)
    {

        $validated = $request->validated();

        Bank::create($validated);

        return redirect()->route('banks.index')->with('message', 'Bank əlavə edildi.');

    }

    /**
     * Display the specified resource.
     */

    public function show(Bank $BankRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Bank $bank)
    {

        return view('banks.edit', compact('bank'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(BankRequest $request, Bank $bank)
    {

        $validated = $request->validated();

        $bank->update($validated);

        return redirect()->back()->with('message', 'Bank dəyişdirildi.');

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Bank $bank)
    {

        $bank->delete();

        return redirect()->back()->with('message', 'Bank silindi.');

    }
}
