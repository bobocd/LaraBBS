<?php

namespace App\Models;
use App\User;

class Reply extends Model
{
    protected $fillable = ['content'];

    public function  user(){
        return $this->belongsTo(User::class);
    }
    public function  topic(){
        return $this->belongsTo(Topic::class);
    }
}
