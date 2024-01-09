<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
      protected $fillable = [
        'plot_id', 'floot_height', 'number_of_floor','target_area'
    ];
}
