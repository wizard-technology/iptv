<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->ct_name,
            'state'=>$this->ct_state == 1 ? 'checked' : '',
            'created'=>$this->created_at,
            'delete'=>route('category.destroy',$this->id),
        ];
    }
}
