<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class Student extends JsonResource
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
    'FirstName'     =>$this->FirstName,
    'LastName'     =>$this->LastName,
    'Identifier'     =>$this->Identifier,
    'Email'     =>$this->Email,
    'DateOfBirth'     =>$this->DateOfBirth,
    'Level'     =>$this->Level,
    'Program'     =>$this->Program,    
    'created_at'     =>$this->created_at,
    'updated_at'     =>$this->updated_at


];
    }
    public function with($request){

        return[
            'version'       =>'1.0.0',
            'author_url'    =>url('')

        ];
    }
}
