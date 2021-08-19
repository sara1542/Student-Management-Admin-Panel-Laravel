<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class Grade extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //Get All data from table
//        return parent::toArray($request);

return[
    'id'             =>$this->id,
    'studentID'     =>$this->studentID,
    'courseID'     =>$this->courseID,
    'Name'     =>$this->Name,
    'Value'     =>$this->Value, 
    'Max'     =>$this->Max,
];
    }
    public function with($request){

        return[
            'version'       =>'1.0.0',
            'author_url'    =>url('')

        ];
    }
}
