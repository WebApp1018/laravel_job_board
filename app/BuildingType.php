<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildingType extends Model
{
    public $fillable = ['building_type','floor_height','number_of_floor','target_area'];
}
