<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    public $fillable = ['year', 'description', 'created_at', 'updated_at'];
}
