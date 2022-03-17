<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller  
{
    public function dropzone() {
        return view('dropzone');
    }
    public function index()
    {
        $employee = Employee::all();
        return view ('employee.index')->with('employee', $employee);
    }
    
    public function create()
    {
        return view('partials.employee_form');
    }
  
    public function store(Request $request)
    {       
        $request->validate([
            'name'=>'required|string',
            'email' => 'required|email:rfc,dns|unique:employees,email',
            'mobile'=>' required|digits:10|unique:employees,mobile',
            'dob'=>'required|date_format:Y-m-d',
            'designation'=>'required|string',
            'doj'=>'required|date_format:Y-m-d',
        ]);
        $input = $request->all();
        // check if file present or not
        // if($request->file()) {
        //     $fileName = time().'_'.$request->profile_picture->getClientOriginalName();
        //     $request->file('profile_picture')->move('uploads', $fileName);
        //     $input['profile_picture'] =  $fileName;
        // }
        
        $tempFile = File::files(public_path().'/temp')[0];
        $tempFileName = $tempFile->getFilename();
        File::move(public_path(). '/temp'. '/' . $tempFileName, public_path(). '/uploads'. '/' . $tempFileName);
        $input['profile_picture'] =  $tempFileName;
        Employee::create($input);
        return redirect('employee')->with('flash_message', 'Employee Addedd!');  
    }
    
    public function show($id)
    {
        $employee = Employee::find($id);
        return view('employee.show')->with('employee', $employee);
    }
    
    public function edit(Request $request, $id)
    {
     
        $employee = Employee::find($id);
        return view('partials.employee_form', compact('employee'))->with('employee', $employee);
    }
  
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|string',
            'email' => 'required|email:rfc,dns|unique:employees,email,'. $id.',id',
            'mobile'=>' required|digits:10|unique:employees,mobile,'. $id.',id',
            'dob'=>'required|date_format:Y-m-d',
            'designation'=>'required|string',
            'doj'=>'required|date_format:Y-m-d',
            // 'profile_picture' => 'nullable|mimes:jpeg,bmp,png,jpg|max:2048',
        ]);
        $tempFile = File::files(public_path().'/temp')[0];

        $tempFileName = $tempFile->getFilename();
        File::move(public_path(). '/temp'. '/' . $tempFileName, public_path(). '/uploads'. '/' . $tempFileName);
        $employee = Employee::find($id);
        $input = $request->all();
        $destination = 'uploads/'.$employee->profile_picture;
        if(File::exists($destination))
        {
            File::delete($destination);
        }

        $input['profile_picture'] =  $tempFileName;
 
        $employee->update($input);
        return redirect('employee')->with('flash_message', 'employee Updated!');  
    }
    public function document_upload(Request $request) 
    {
        if($request->hasFile('file')){
            $file = $request->file('file');
            $completeFileName = time().'_'. $file->getClientOriginalName();
            $request->file('file')->move('temp', $completeFileName);
        }
    }

    public function destroy($id)
    {
        Employee::destroy($id);
        // Employee::where('id', $id)->withTrashed()->forceDelete();
        return redirect('employee')->with('flash_message', 'employee deleted!');  
    }

//     public function restore($id) 
//   {
//         Employee::where('id', $id)->withTrashed()->restore();

//         return redirect('employee') ->withSuccess(__('User restored successfully.'));
//   }
}