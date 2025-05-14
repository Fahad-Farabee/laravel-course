<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\MockObject\Builder\Stub;

class StudentController extends Controller
{
    function list()
    {
        return Student::all();
    }

    function add_student(Request $request)
    {
        /*  $student = new Student();
        $student->name = $request->name;
        $student->subject = $request->subject; */
        //making validations.
        $rules = array(
            'name' => 'required | min:2 | max:10',
            'subject' => 'required'
        );
        $validation = Validator::make($request->all(), $rules);
        /* $dataToValidate = $request->only(['name']);
        $validation = Validator::make($dataToValidate, $rules); */
        if ($validation->fails()) {
            return $validation->errors();
        } else {
            $student = new Student();
            $student->name = $request->name;
            $student->subject = $request->subject;

            //if we use new instance, then it will insert in the data base.
            if ($student->save()) {
                return ["result" => "student added"];
            } else {
                return ["result" => "operation failed"];
            }
        }

        /*   $validated = $request->validate([
            'name' => 'required',
            'subject' => 'required'
        ]);

        $student = new Student();
        $student->name = $request->name;
        $student->subject = $request->subject;

        //if we use new instance, then it will insert in the data base.
        if ($student->save()) {
            return ["result" => "student added"];
        } else {
            return ["result" => "operation failed"];
        } */
    }

    function update_student(Request $request)
    {
        $student = Student::find($request->id);
        $student->name = $request->name;
        $student->subject = $request->subject;

        //if we use find, then it will update the database.
        if ($student->save()) {
            return ["result" => "student information updated"];
        } else {
            return ["result" => "Operation Failed"];
        }
    }

    function delete_student($id)
    {
        $student = Student::destroy($id);
        if ($student) {
            return ["result" => "Student record deleted"];
        } else {
            return ["result" => "Student may not exist or student has already been removed"];
        }
    }

    function search_student($name)
    {
        $student = Student::where('name', 'like', "%$name%")->get();
        if ($student) {
            return ["result" => $student];
        } else {
            return ["result" => "Student not found"];
        }
    }
}
