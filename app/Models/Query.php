<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    public function question(){
        return $this->hasMany('App\Models\Question');
    }
}
