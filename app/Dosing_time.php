<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosing_time extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'dosing_time',
        'drug_name',
        'note',
        'dosing_flag'
    ];
    
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
