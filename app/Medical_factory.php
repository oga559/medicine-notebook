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
        return $this->hasOne(Post::class);
    }
    public function photo_post()
    {
        return $this->hasOne(Photo_post::class);
    }
}
