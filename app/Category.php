<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
      public $fillable = ['user_id','project_id','title','parent_id'];

    /**

     * Get the index name for the model.

     *

     * @return string

     */

    public function childs() {

        //$td =  $this->hasMany('App\Category','parent_id','id')->orderBy('basement_sort_order','ASC')->orderBy('floor_sort_order','ASC');
        //dd($td);
        $td =  $this->hasMany('App\Category','parent_id','id')->orderBy('sort_order','ASC');
        return $td;
    }
    public function floor_childs() {
        
        $t = $this->hasMany('App\Category','parent_id','id')->orderBy('floor_sort_order','ASC');
        //dd($t);
        return $t;
    }
    public function basement_childs() {

        return $this->hasMany('App\Category','parent_id','id')->orderBy('basement_sort_order','ASC');

    }
}
