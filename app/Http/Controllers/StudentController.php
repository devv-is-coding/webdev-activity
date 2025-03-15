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
            'age' => ['required', 'numeric', 'min:10', 'max:18'],
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

    public function updateSTD(Request $request, $id){
        $request->validate([
            'name' => ['required','string','max:255'],
            'age' => ['required', 'integer','min:10','max:18'],
            'gender' => ['required', 'string','max:255'],
            'address' => ['required','string','max:255']
        ]);
         $updateSTD = Student::findOrFail($id);
         $updateSTD->name = $request->name;
         $updateSTD->age = $request->age;
         $updateSTD->gender = $request->gender;
         $updateSTD->address = $request->address;
         $updateSTD->save();

        return back()->with('success', 'Student updated successfully');
    }
    public function deleteSTD($id){
        $deleteSTD = Student::findOrFail($id);
        $deleteSTD->delete();

        return back()->with('success', 'Student deleted successfully');
    }
}
