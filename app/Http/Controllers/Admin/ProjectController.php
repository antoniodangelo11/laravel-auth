<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    private $validations = [
        "title"            => "required|string|min:3|max:50",
        "creation_date"    => "required|date",
        "last_update"      => "required|date",
        "author"           => "required|string|min:3|max:30",
        "collaborators"    => "string|min:5|max:150",
        "description"      => "string|min:10|max:2000",
        "languages"        => "required|string|max:50",
        "link_github"      => "required|string|max:150",
    ];

    private $validation_messages = [
        'required'  => 'Il campo :attribute è obbligatorio',
        'min'       => 'Il campo :attribute deve avere almeno :min caratteri',
        'max'       => 'Il campo :attribute non può superare i :max caratteri',
        'url'       => 'Il campo deve essere un url valido',
    ];

    public function index()
    {
        $projects = Project::paginate(4);

        return view('admin.projects.index', compact('projects'));
    }


    public function create()
    {
        return view('admin.projects.create');
    }


    public function store(Request $request)
    {
        $request->validate($this->validations, $this->validation_messages);

        $data = $request->all();

        // salvare i dati nel db
        $newProject = new Project();
        
        $newProject->title = $data['title'];
        $newProject->creation_date = $data['creation_date'];
        $newProject->last_update = $data['last_update'];
        $newProject->author = $data['author'];
        $newProject->collaborators = $data['collaborators'];
        $newProject->description = $data['description'];
        $newProject->languages = $data['languages'];
        $newProject->link_github = $data['link_github'];

        $newProject->save();

        // rotta di tipo get
        return to_route('admin.projects.show', ['project' => $newProject]);
    }


    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }


    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }


    public function update(Request $request, Project $project)
    {
        // validare i dati del form
        $request->validate($this->validations, $this->validation_messages);

        $data = $request->all();

        // aggiornare i dati nel db
        $project->title = $data['title'];
        $project->creation_date = $data['creation_date'];
        $project->last_update = $data['last_update'];
        $project->author = $data['author'];
        $project->collaborators = $data['collaborators'];
        $project->description = $data['description'];
        $project->languages = $data['languages'];
        $project->link_github = $data['link_github'];
        
        $project->update();

        // rotta di tipo get
        return to_route('admin.projects.show', ['project' => $project]);
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('admin.projects.index')->with('delete_success', $project);
    }
}