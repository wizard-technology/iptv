<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public function category()
    {
        return $this->belongsTo(Categore::class, 'ch_category');
    }
    public function app()
    {
        return $this->hasMany(ChannelApp::class, 'ac_channel');
    }
}
