<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChannelResource extends JsonResource
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
            'title'=>$this->ch_title,
            'subtitle'=>$this->ch_subtitle,
            'link'=>$this->ch_link,
            'image'=>$this->ch_image,
            'star'=>$this->ch_star,
            'state'=>$this->ch_state == 1 ? 'checked' : '',
            'created'=>$this->created_at,
            'delete'=>route('channel.destroy',$this->id),
        ];
    }
}
