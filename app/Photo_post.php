<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo_post extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'medical_factories_id',
        'photo',
        'prescription_date',
        'medical_subjects',
        'note'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function medical_factory()
    {
        return $this->hasOne(Medical_factory::class);
    }
}
