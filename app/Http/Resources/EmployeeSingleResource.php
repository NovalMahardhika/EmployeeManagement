<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeSingleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $date = Carbon::parse($this->birthdate);
       
        return [
            "id"=>$this->id,
            "username"=>$this->username,
            "last_name"=>$this->last_name,
            "first_name"=>$this->first_name,
            "middle_name"=>$this->middle_name,
            "birthdate"=>($date) ? $date->isoFormat('dddd, Do MMMM YYYY') : 'Belom di Isi',
            
            
        ];
    }
}
    