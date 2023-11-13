<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:list-plans|create-plans|edit-plans|delete-plans', ['only' => ['index','show']]);
        $this->middleware('permission:create-plans', ['only' => ['create','store']]);
        $this->middleware('permission:edit-plans', ['only' => ['edit']]);
        $this->middleware('permission:delete-plans', ['only' => ['destroy']]);

    }

    public function index()
    {

        $plans = Plan::orderBy('id', 'DESC')->get();
        return view('plans.index', compact( 'plans'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $plan  = new Plan();

        $request->validate([
            'title'=>'required'
        ]);

        $plan->title = $request->title;
        $plan->number = $request->number;


        $plan->save();

        return redirect()->route('plans.index')->with('message', 'Plan əlavə edildi.');

    }

    /**
     * Display the specified resource.
     */

    public function show(Plan $PlanRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Plan $plan)
    {

        return view('plans.edit', compact('plan'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Plan $plan)
    {

        $request->validate([
            'title'=>'required'
        ]);

        $plan->title = $request->title;
        $plan->number = $request->number;

        $plan->save();

        return redirect()->back()->with('message', 'Plan dəyişdirildi.');

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Plan $plan)
    {

        $plan->delete();
        return redirect()->back()->with('message', 'Plan silindi.');

    }
}
