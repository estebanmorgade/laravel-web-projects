<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Events\ProjectSaved;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SaveProjectRequest;
use App\Http\Resources\ProjectResource;

class ApiProjectController extends Controller
{
    /* Define middleware */

    public function __construct(){

        $this->middleware('auth:sanctum')->except('index', 'show');

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProjectResource::collection(Project::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveProjectRequest $request)
    {
        $project = new Project($request->validated());

        $project->user_id = auth()->id(); // Set the user_id to the authenticated user's ID

        $this->authorize('create', $project);

        $project->image = $request->file('image')->store('images');

        $project->save();

        ProjectSaved::dispatch($project);

        return new ProjectResource($project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Project $project, SaveProjectRequest $request)
    {
        $this->authorize('update', $request->project());
        $project->update($request->validated());
        return new ProjectResource($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
        $project->delete();
        return response()->json(['message' => 'Project deleted']);
    }
}
