<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
       
        //$projects = Project::all();  >Lists all projects inside the table
        //$projects = Project::simplePaginate(20);  >Paginates without showing the number of pages left
        //$projects = Project::orderBy('created', 'DESC')->paginate(20); >Paginates and sorts items from recent to  oldest
        
        $projects = Project::orderBy('id', 'desc')->paginate(20);  //Paginates and shows declared amount of items
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create', ["project" => new Project(), "types" => Type::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $formData = $request->all();
        $formData = $request->validate([
            'title' => 'required|max:200',
            'description' => 'required|max:400',
            'link' => 'required|url|max:400|unique:projects',
            'created' => 'required|date',
            'image' => 'required|image|max:2048',
            'type_id' => 'exists:types,id'
        ], 
        [
            'title.required' => 'Il titolo non può essere lasciato vuoto',
            'title.max' => 'Il titolo supera i 200 caratteri massimi',
            'description.required' => 'La descrizione non può essere lasciata vuota',
            'description.max' => 'La descrizione supera i 400 caratteri massimi',
            'link.required' => 'La url non può essere lasciata vuota',
            'link.max' => 'La url supera i 400 caratteri massimi',
            'link.url' => 'Inserisci una URL valida',
            'created.required' => 'Inserire la data mancante',
            'image.required' => 'File immagine mancante',
            'image.max' => 'Il file supera i 2mb di dimensione massima',
        ]);

        $formData['slug'] = Str::slug($formData['title']); //Makes a new string title from matching id
        $formData['image'] = Storage::put('imgs/', $formData['image']);

        $newProject = new Project();
        $newProject->fill($formData);
        $newProject->save();

        return redirect()->route('admin.projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        // Variables to navigate items back and forth from within another item
        $next = Project::where('id', '>', $project->id)->orderBy('id')->first();
        $prev = Project::where('id', '<', $project->id)->orderBy('id','desc')->first();

        return view('admin.projects.show', compact('project', 'next', 'prev'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', ["project" => $project, "types" => Type::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $formData = $request->validate([
            'title' => ['required', 'max:200'],
            'description' => ['required', 'max:400'],
            'link' => ['required', 'max:400', 'url', Rule::unique('projects')->ignore($project->id)],
            'created' => 'required|date',
            'image' => 'required|image|max:2048',
            'type_id' => 'exists:types,id'
        ],
        [
            'title.required' => 'Il titolo non può essere lasciato vuoto',
            'title.max' => 'Il titolo supera i 200 caratteri massimi',
            'description.required' => 'La descrizione non può essere lasciata vuota',
            'description.max' => 'La descrizione supera i 400 caratteri massimi',
            'link.required' => 'La url non può essere lasciata vuota',
            'link.max' => 'La url supera i 400 caratteri massimi',
            'link.url' => 'Inserisci una URL valida',
            'created.required' => 'Inserire la data mancante',
            'image.required' => 'File immagine mancante',
            'image.max' => 'Il file supera i 2mb di dimensione massima',
        ]);

        $project->update($formData);

        return redirect()->route('admin.projects.show', compact('project'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {   
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
