<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public function channel()
    {
        return $this->hasMany(ChannelApp::class, 'ac_app');
    }
}
