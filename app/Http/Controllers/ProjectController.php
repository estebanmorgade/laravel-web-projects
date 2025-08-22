<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Events\ProjectSaved;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SaveProjectRequest;

class ProjectController extends Controller
{

    /* Define middleware */

    public function __construct(){

        $this->middleware('auth')->except('index', 'show');

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //$portafolio = Project::get();// get obtiene todos los datos del modelo

        if($request->boolean('deletes')){
            $this->authorize('viewDeleted', Project::class);

            return view('projects.index', [
                'deletes' => true,
                'projects' => Project::with('category')->onlyTrashed()->latest()->paginate(6)// latest obtiene todos los datos del modelo ordenados DESC de la columna indicada, por def. 'created_at'
                                            // paginate crea paginado por def. de a 15 rows
            ]);
        }

        if(auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin'){
            return view('projects.index', [
                'newProject' => new Project,
                'projects' => Project::with('category')->latest()->paginate(6)// latest obtiene todos los datos del modelo ordenados DESC de la columna indicada, por def. 'created_at'
                                            // paginate crea paginado por def. de a 15 rows
            ]);
        }
        else{
            return view('projects.index', [
                'newProject' => new Project,
                'projects' => auth()->user()->projects()->with('category')->latest()->paginate(6)
                            // get the projects of the authenticated user
            ]);
        }

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('projects.create', [
            'project' => new Project,
            'categories' => Category::pluck('name','id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveProjectRequest $request)
    {

        // ESTA ES UNA FORMA
        /*Project::create([
            'title' => $request->title,
            'url' => $request->url,
            'description' => $request->description
        ]);*/

        // Y ESTA ES OTRA

        //Project::create($request->all());

        $project = new Project($request->validated());

        $project->user_id = auth()->id(); // Set the user_id to the authenticated user's ID

        $this->authorize('create', $project);

        $project->image = $request->file('image')->store('images');

        $project->save();

        ProjectSaved::dispatch($project);

        return redirect()->route('projects.index')->with('status', 'El proyecto fue creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //$project = Project::findOrFail($id);

        return view('projects.show', compact('project'));
    }

    /* Display soft-deleted projects */
    public function showDeleted($projectUrl)
    {
        $project = Project::withTrashed()->whereUrl($projectUrl)->firstOrFail();

        $this->authorize('viewDeleted', $project);

        return view('projects.showDeleted', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        $categories = Category::pluck('name','id');
        return view('projects.edit', compact('project', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Project $project, SaveProjectRequest $request)
    {
        $this->authorize('update', $project);

        if ($request->hasFile('image')) {
            Storage::delete($project->image);

            $project->fill($request->validated());

            $project->image = $request->file('image')->store('images');

            $project->save();

            ProjectSaved::dispatch($project);

        }
        else{
            $project->update(array_filter($request->validated()));
        }

        return redirect()->route('projects.show', $project)->with('status', 'El proyecto fue actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        //Project::delete($project); OTRA FORMA DE ELIMINAR REGISTRO
        Storage::delete($project->image);

        $project->delete();
        
        return redirect()->route('projects.index')->with('status','El proyecto fue eliminado');
    
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($projectUrl)
    {
        $project = Project::withTrashed()->whereUrl($projectUrl)->firstOrFail();

        $this->authorize('restore', $project);

        $project->restore();
        
        return redirect()->route('projects.index',['deletes' => 'true'])->with('status','El proyecto fue restaurado');
    
    }

    /* Remove the specified resource definitly */
    public function forceDelete($projectUrl)
    {
        $project = Project::withTrashed()->whereUrl($projectUrl)->firstOrFail();

        $this->authorize('forceDelete', $project);

        Storage::delete($project->image);

        $project->forceDelete();

        return redirect()->route('projects.index', ['deletes' => 'true'])->with('status','El proyecto fue eliminado definitivamente');
    }
}
