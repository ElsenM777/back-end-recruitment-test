<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['body'];

    public function answer(){
        return $this->hasMany('App\Models\Answer');
    }

}
