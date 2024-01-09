<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlotType extends Model
{
     public $fillable = ['plot_type'];
     protected $primaryKey = 'id_plot';
}
