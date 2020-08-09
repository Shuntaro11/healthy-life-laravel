<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = [
        'ate_at', 'quantity', 'user_id', 'food_ingredient_id'
    ];

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }

    public function food_ingredient()
    {
        return $this->belongsTo(\App\FoodIngredient::class, 'food_ingredient_id', 'id');
    }

}
