<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodIngredient extends Model
{
    protected $fillable = [
        'food_name'
    ];

    public function meals()
    {
        return $this->hasMany('App\Meal', 'food_ingredient_id', 'id');
    }
}
