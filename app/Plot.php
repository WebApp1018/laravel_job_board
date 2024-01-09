<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plot extends Model
{
    

     protected $fillable = [
        'plot_id', 'width', 'height','length'
    ];
}
