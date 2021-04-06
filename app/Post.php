<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'medical_factory_id',
        'drug_name',
        'prescription_date',
        'medical_subjects',
        'note',
        'week'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function medical_factory()
    {
        return $this->belongsTo(Medical_factory::class);
    }
}
