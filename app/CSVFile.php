<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CSVFile extends Model
{
    protected $fillable = [
        'user_id',
        'project_id',
        'name',
        'email',
        'file_name',
        'file_path',
        'updated_at',
        'deleted_at',
      
    ];
}
