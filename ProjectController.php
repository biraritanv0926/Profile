<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Project;
class ProjectController extends Controller
{
    public function index()
    {
        $project = Project::all()->sortByDesc("name");
        return view ('project.index')->with('project', $project);
    }
    
    public function create()
    {       
        $employees = Employee::all();
        return view('partials.form_project', ['employees' => $employees]);     
    }
  
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|unique:projects,name',
            'description' => 'nullable|string',
            'technology'=>' required|string',
            'start_date'=>'required|date|before:end_date',
            'end_date'=>'required|date|after:start_date',
        ]);

        $input = $request->all();
        $project = Project::create($input);
        $project->employee()->attach($input['employee_id']);
        return redirect('project')->with('flash_message', 'Project Addedd!');  
    }
    
    public function show($id)
    {
        $project = Project::find($id);
        return view('project.show')->with('project', $project);
    }
    
    public function edit(Request $request, $id)
    {
        $project = Project::find($id);
        $employees = Employee::all();
        $projectEmployees = $project->employee()->pluck('id')->toArray();

        return view('partials.form_project', ['project' => $project,  'employees' => $employees, 'projectEmployees' => $projectEmployees ]);
    }
  
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|string|unique:projects,name,'. $id.',id',
            'description' => 'nullable|string',
            'technology'=>' required|string',
            'start_date'=>'required|date|before:end_date',
            'end_date'=>'required|date|after:start_date',
        ]);
        
        $input = $request->all();
        $project = Project::find($id);
        $project->update($input);

        if (array_key_exists("employee_id", $input))
        $project->employee()->sync($input['employee_id']);
        else
        $project->employee()->detach();

        return redirect('project')->with('flash_message', 'project Updated!');  
    }
  
    public function destroy($id)
    {
        Project::destroy($id);
        return redirect('project')->with('flash_message', 'project deleted!');  
    }
}