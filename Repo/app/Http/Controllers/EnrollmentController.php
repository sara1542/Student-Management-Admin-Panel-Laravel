<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Http\Resources\Enrollment as EnrollmentResource;
use App\Models\Grade;
use App\Http\Resources\Grade as GradeResource;
use App\Models\Item;
use App\Http\Resources\Item as ItemResource;
use Illuminate\Support\Facades\DB;


class EnrollmentController extends Controller
{
    public function Enroll(Request $request)
    {
        $enroll =  $request->isMethod('put') ?  : new Enrollment();
        $enroll->student       =$request->input('student');
        $enroll->course    =$request->input('course');
        $enroll->save();
        
        $Items = Item::where('courseID', $enroll->course)->get();
        $array = json_decode($Items);
        foreach ($array as $key => $jsons) { // This will search in the 2 jsons
            $grade = $request->isMethod('put') ? : new Grade();
            $grade->studentID       =$enroll->student  ;
            $grade->courseID       =$enroll->course  ;
            $grade->Value            =        0;
            foreach($jsons as $key => $value) {
                if($key=='Name'){
                $grade->Name    =$value;
                }
                if($key=='Max'){
                    $grade->Max     =$value;
                }
        }
       error_log($grade);
       $grade->save();
       }
       
    
            return new EnrollmentResource($enroll);

        

    }
}
