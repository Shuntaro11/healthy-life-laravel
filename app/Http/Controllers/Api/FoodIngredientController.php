<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use \App\FoodIngredient;
use Request;

class FoodIngredientController extends Controller
{
    public function index()
    {
        $queryFoodName = Request::input('food_name');
        if (!empty($queryFoodName)) {
            return FoodIngredient::select('id', 'food_name')
                ->where('food_name', 'LIKE', "%$queryFoodName%")
                ->get();
        }
        return [];
    }
}
