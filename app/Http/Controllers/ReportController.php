<?php

namespace App\Http\Controllers;

use App\Models\BankPayment;
use App\Models\Income;
use App\Models\Institution;
use App\Models\Plan;
use App\Models\Purchase;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    public function __construct()
    {

        $this->middleware('permission:list-reports|create-reports|edit-reports|delete-reports', ['only' => ['index','show']]);
        $this->middleware('permission:create-reports', ['only' => ['create','store']]);
        $this->middleware('permission:edit-reports', ['only' => ['edit']]);
        $this->middleware('permission:delete-reports', ['only' => ['destroy']]);

    }

    public function index()
    {

        $reports = Purchase::with('products','bank_payments')->get();

        return view('reports.index',compact('reports'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {



    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     */

    public function show(Report $ReportRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {


    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Report $report)
    {



    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Report $report)
    {



    }
}
