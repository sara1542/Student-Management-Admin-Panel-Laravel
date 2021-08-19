<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Resources\Student as StudentResource;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index($id)
    {
        $students =  DB::table('students')
            ->join('enrollment', function ($join)  use ($id) {
                $join->on('students.id', '=', 'enrollment.student')->where('enrollment.course', '=', $id);
            })
            ->select('students.*')
            ->get();
        error_log($students);
        return StudentResource::collection($students);
    }
    public function view($id)
    {
        $students =  DB:: table ('students')
        ->whereNotIn('id', function($query)  use($id)
        {
            $query->select('id')->from('students')
            ->join('enrollment', function($join)  use($id){
                $join->on('students.id', '=', 'enrollment.student')->where('enrollment.course','=',$id); });
        })  
        -> select ('students.*')
        ->get();
         return StudentResource::collection($students);
    }
    public function index2()
    {
        $students = Student::orderBy('id', 'asc')->get();
        //  $students=DB::table('students')->where('Identifier', '=', '2018114')->get();
        return StudentResource::collection($students);
    }
    public function store(Request $request)
    {
        $student = $request->isMethod('put') ? Student::findOrFail($request->student_id) : new Student();
        $student->id       = $request->input('student_id');
        $student->FirstName    = $request->input('FirstName');
        $student->LastName     = $request->input('LastName');
        $student->Identifier     = $request->input('Identifier');
        $student->Email     = $request->input('Email');
        $student->DateOfBirth     = $request->input('DateOfBirth');
        $student->Level     = $request->input('Level');
        $student->Program     = $request->input('Program');

        if ($student->save()) {
            return new StudentResource($student);
        }
    }

    public function show($id)
    {
        //Get Single Article
        $student = Student::findOrFail($id);

        //Return Single Article as a resource
        return new StudentResource($student);
    }

    public function destroy($id)
    {
        //Get Single Article
        $student = Student::findOrFail($id);

        //Delete Single Article with a resource
        if ($student->delete()) {
            return new StudentResource($student);
        }
    }

    public function search($selected, $valueToSearch)
    {
        $students = Student::where($selected, $valueToSearch)->get();
        return StudentResource::collection($students);
    }
}
