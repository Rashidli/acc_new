<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Institution;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:list-projects|create-projects|edit-projects|delete-projects', ['only' => ['index','show']]);
        $this->middleware('permission:create-projects', ['only' => ['create','store']]);
        $this->middleware('permission:edit-projects', ['only' => ['edit']]);
        $this->middleware('permission:delete-projects', ['only' => ['destroy']]);

    }

    public function index()
    {

        $projects = Project::orderBy('id', 'DESC')->get();
        return view('projects.index', compact( 'projects'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ins = Institution::all();
        return view('projects.create', compact('ins'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(ProjectRequest $request)
    {

        $validated = $request->validated();

        Project::create($validated);

        return redirect()->route('projects.index')->with('message', 'Layihə əlavə edildi.');

    }

    /**
     * Display the specified resource.
     */

    public function show(Project $ProjectRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Project $project)
    {

        $ins = Institution::all();
        return view('projects.edit', compact('project' ,'ins'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(ProjectRequest $request, Project $project)
    {

        $validated = $request->validated();


        $project->update($validated);

        return redirect()->back()->with('message', 'Layihə dəyişdirildi.');

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Project $project)
    {

        $project->delete();

        return redirect()->back()->with('message', 'Layihə silindi.');

    }
}
