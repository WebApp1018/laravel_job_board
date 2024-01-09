<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public $fillable = ['room_type','room_area'];
}
