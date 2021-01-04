<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationApp extends JsonResource
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
            'link' => openssl_encrypt($this->ch_link, 'aes-256-cbc', "2ed8s4xgzwknjl6i16z4yqpndh3xrg6j", 0, "e16ce913a20dadb8"),
            'image' => asset('storage/' . $this->ch_image),
        ];
    }
}
