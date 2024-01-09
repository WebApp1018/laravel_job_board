<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JsonFile extends Model
{
    protected $fillable = [
        'user_id',
        'project_id',
        'json0',
        'project_revision',
        'updated_at',
        'deleted_at',
      
    ];
}
