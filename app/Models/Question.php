<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }
    public function questions()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
