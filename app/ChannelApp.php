<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChannelApp extends Model
{
    public function channel()
    {
        return $this->belongsTo(Channel::class, 'ac_channel');
    }
    public function app()
    {
        return $this->belongsTo(Application::class, 'ac_channel');
    }
}
