<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
        $date_hired = Carbon::parse($this->date_hired);
        return [
            "id"=>$this->id,
            "username"=>$this->username,
            "last_name"=>$this->last_name,
            "first_name"=>$this->first_name,
            "middle_name"=>$this->middle_name,
            "birthdate"=>($date) ? $date->isoFormat('dddd, Do MMMM YYYY') : 'Belom di Isi',
            "address"=>$this->address,
            "department"=>$this->department->name,
            "country"=>$this->country->name,
            "city"=>$this->city->name,
            "zip_code" =>$this->zip_code,
            "date_hired" => ($date_hired) ? $date_hired->isoFormat('dddd, Do MMMM YYYY') : 'Belom di Isi',
            
        ];
    }
}
    