<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Blogs extends Model
{
    //
    protected $fillable = [
        'title', 'description', 'image', 'slug', 'status'
    ];
    protected static function boot()
    {
        parent::boot();
        static::created(function ($blog) {
            $blog->slug = $blog->generateSlug($blog->title);
            $blog->save();
        });
    }
    
    private function generateSlug($title)
    {
        if (static::whereSlug($slug = Str::slug($title))->exists()) {
            $max = static::whereTitle($title)->latest('id')->skip(1)->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    } 


}
