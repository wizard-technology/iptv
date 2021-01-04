<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppResourse extends JsonResource
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
            'name'=>$this->app_name,
            'access'=>$this->app_access,
            'secret'=>$this->app_secret,
            'fcm'=>$this->app_fcm,
            'platform'=>$this->app_type,
            'state'=>$this->app_state == 1 ? 'checked' : '',
            'created'=>$this->created_at,
            'delete'=>route('app.destroy',$this->id),
        ];
    }
}
