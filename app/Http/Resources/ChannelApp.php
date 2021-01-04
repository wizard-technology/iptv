<?php

namespace App\Http\Resources;

use App\Channel;
use Illuminate\Http\Resources\Json\JsonResource;

class ChannelApp extends JsonResource
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
            'title' => $this->ch_title,
            'subtitle' => $this->ch_subtitle,
            'rating' => $this->ch_star,
            'link' => $this->ch_link,
            'image' => $this->ch_image,
        ];
    }
}
