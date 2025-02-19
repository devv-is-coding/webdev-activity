<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index() 
    {
        $students = Student::all();
        return view('layouts.ViewStudents', compact('students'));
    }

    public function createNewSTD(Request $request){
        $request->validate([
            'name' => ['required','string','max:255'],
            'age' => ['required', 'integer','min:10','max:18'],
            'gender' => ['required', 'string','max:255'],
            'address' => ['required','string','max:255']
        ]);

         $addNewSTD = new Student();
         $addNewSTD->name = $request->name;
         $addNewSTD->age = $request->age;
         $addNewSTD->gender = $request->gender;
         $addNewSTD->address = $request->address;
         $addNewSTD->save();

        return back()->with('success', 'Student created successfully');
    }
}
