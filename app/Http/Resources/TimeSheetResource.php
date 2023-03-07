<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TimeSheetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'user_id' =>$this->user_id,
            'shift_id' =>$this->shift_id,
            'department_id' =>$this->department_id,
            'date' =>$this->date,
            'shiftTitle'=>$this->shift->title,
            'departmentName'=>$this->department->name

        ];
    }
}
