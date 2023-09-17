<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstitutionRequest;
use App\Models\Institution;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{

    public function __construct()
    {

        $this->middleware('permission:list-institutions|create-institutions|edit-institutions|delete-institutions', ['only' => ['index','show']]);
        $this->middleware('permission:create-institutions', ['only' => ['create','store']]);
        $this->middleware('permission:edit-institutions', ['only' => ['edit']]);
        $this->middleware('permission:delete-institutions', ['only' => ['destroy']]);

    }

    public function index()
    {

        $institutions = Institution::orderBy('id', 'DESC')->get();
        return view('institutions.index', compact( 'institutions'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('institutions.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(InstitutionRequest $request)
    {

        $validated = $request->validated();

        Institution::create($validated);

        return redirect()->route('institutions.index')->with('message', 'Müəssisə əlavə edildi.');

    }

    /**
     * Display the specified resource.
     */

    public function show(Institution $InstitutionRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Institution $institution)
    {


        return view('institutions.edit', compact('institution' ));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(InstitutionRequest $request, Institution $institution)
    {

        $validated = $request->validated();


        $institution->update($validated);

        return redirect()->back()->with('message', 'Müəssisə dəyişdirildi.');

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Institution $institution)
    {

        $institution->delete();

        return redirect()->back()->with('message', 'Müəssisə silindi.');

    }
}
