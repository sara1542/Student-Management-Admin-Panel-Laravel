<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Http\Resources\Program as ProgramResource;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{
    public function index(){
        $programs = Program::orderBy('id','asc')->get();
       return ProgramResource::collection($programs);   }

   public function store(Request $request)
   {
       $program = $request->isMethod('put') ? Program::findOrFail($request->program_id) : new Program();
       $program->id       =$request->input('program_id');
       $program->Name    =$request->input('Name');
       $program->Description     =$request->input('Description');
       if($program->save()){
           return new ProgramResource($program);
       }
    } 

   public function show($id)
   {
       //Get Single Article
       $course = Program::findOrFail($id);

       //Return Single Article as a resource
       return new ProgramResource($course);
   }

   public function destroy($id)
   {
       //Get Single Article
       $program = Program::findOrFail($id);

       //Delete Single Article with a resource
       if($program->delete()){
           return new ProgramResource($program);
       }
   }

   public function search($selected, $valueToSearch)
   {
       $programs = Program::where($selected,$valueToSearch)->get();
       return ProgramResource::collection($programs);
   }
}
