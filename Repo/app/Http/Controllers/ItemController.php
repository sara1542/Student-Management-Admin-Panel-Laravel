<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Http\Resources\Item as ItemResource;
use App\Models\Enrollment;
use App\Http\Resources\Enrollment as EnrollmentResource;
use App\Models\Grade;
use App\Http\Resources\Grade as GradeResource;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{

   public function store(Request $request)
   {
        $item = $request->isMethod('put') ? Item::findOrFail($request->item_id)  : new Item();
        $item->id       =$request->input('item_id');
        $item->courseID       =$request->input('courseID');
        $item->Name    =$request->input('Name');
        $item->Max     =$request->input('Max');
        $item->Description     =$request->input('Description');
        error_log($item->courseID);
        error_log($item->Name);
        error_log($item->Max);
        error_log($item->Description);

        $students = Enrollment::where('course', $item->courseID)->get();
        $array = json_decode($students);
        foreach ($array as $key => $jsons) { // This will search in the 2 jsons
            $grade = $request->isMethod('put') ? Grade::where('courseID',$request->courseID)->where('Name',$request->Name)->first(): new Grade();
            $grade->courseID       =$item->courseID  ;
            $grade->Value            =        0;
            $grade->Name=$item->Name;
            $grade->Max=$item->Max;
            foreach($jsons as $key => $value) {
                if($key=='student'){
                $grade->studentID    =$value;
                }
         }
       error_log($grade);
       $grade->save();
       }

        if($item->save()){
            error_log($item);
             return new ItemResource($item);
    }

    } 

   public function show($courseIDD)
   {
       $Items = Item::where('courseID',$courseIDD)->get();
       return ItemResource::collection($Items);
   }

   public function destroy($courseID,$Name)
   {
       $item = Item::where('courseID',$courseID) ->where('Name',$Name);
       
       $grade = Grade::where('courseID',$courseID) ->where('Name',$Name);
       $grade->delete();
       
       if($item->delete()){
            return response()->json([]);
      }
    
   }

}
