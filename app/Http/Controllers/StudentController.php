<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    function store(Request $request)
    {
        $student=new Student();
        $student->name=$request->name;
        $student->email=$request->email;
        $student->phone=$request->phone;
        $student->course=$request->course;
        $result=$student->save();
        if($request)
        {
            return response()->json(
                "Data saved successfully..."
            );
        }
        else{
            return response()->json(
                "Error in saving the data..."
            );
        }
    }

    public function show()
    {
        $students=Student::all();
      
        return view('index', compact('students'));
        
        
    }
    
    function edit($id,Student $student)
    {
        $editstudent=Student::find($id);
        return view('index', ['student'=>$student]);

    }
}
