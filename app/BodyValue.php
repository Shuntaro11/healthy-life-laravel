<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BodyValue extends Model
{
    protected $fillable = [
        'date', 'weight', 'height', 'bmi', 'user_id'
    ];

    protected $dates = [
        'date'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
