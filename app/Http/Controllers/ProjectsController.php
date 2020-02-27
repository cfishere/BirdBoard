<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Http\Requests\UpdateProjectRequest;

class ProjectsController extends Controller
{
    public function index()
    {
		//$projects = Project::all();
        // Let's grab only this user's projects:
        $projects = auth()->user()->projects;
		return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(UpdateProjectRequest $request)
    {       
       //$attributes['owner_id'] = auth()->id();
       
        $project = auth()->user()->projects()
            ->create($request->validated());

		return redirect($project->path());
    }

    public function edit(Project $project)
    {

        $this->authorize( 'edit', $project );
        
        return view( 'projects.edit', compact('project') );

    }

    public function show(Project $project)
    {
    	// use 'request' of the GET URI variable, which is defined in 
    	// the web.php Route's URI as {$project}, which will be the 
    	// id value of the project the request wants to get.
        
        //use our auth policy in app/http/policies/ProjectPolicy      
        $this->authorize( 'update', $project );

		return view('projects.show', compact('project'));
    }

    public function update( UpdateProjectRequest $request )
    {    
        //authorization and request validate are handled by 
        //UpdateProjectRequest.
        //...you now can access the form's request data as
        // "$request->validated()":
        $request->persist();
        $project->redirect($request->project()->path());
       
    }


}
