<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Get User Name
    public function user(){
        return $this->belongsTo(User::class);
    }
}
