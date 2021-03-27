<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medical_factory extends Model
{
    protected $fillable = [
        'id',
        'factory_name'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function photo_post()
    {
        return $this->belongsTo(Photo_post::class);
    }
}
