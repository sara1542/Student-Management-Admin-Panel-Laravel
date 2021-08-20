<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Http\Resources\Grade as GradeResource;
use Illuminate\Support\Facades\DB;


class GradeController extends Controller
{
   public function show($id,$courseid){
      // error_log($id,$courseid);
    $grades = Grade::where('courseID',$courseid)->where('studentID',$id)->get();
    return GradeResource::collection($grades);
   }

   public function store(Request $request)
   {
       $grade = $request->isMethod('put') ? Grade::findOrFail($request->grade_id) : new Grade();
       $grade->id       =$request->input('grade_id');
       $grade->Name    =$request->input('Name');
       $grade->Value     =$request->input('Value');
       $grade->Max     =$request->input('Max');
       $grade->StudentID    =$request->input('studentID');
       $grade->courseID     =$request->input('courseID');
       if($grade->save()){
           return new GradeResource($grade);
       }
    } 
    public function fetchGradesForCourse($id){
        $grades = Grade::where('courseID',$id)->get();
        return GradeResource::collection($grades);            
    }
    public function fetchGradesForStudent($id){
        $grades = Grade::where('studentID',$id)->get();
        return GradeResource::collection($grades);            
    }
}
