<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Meal;
use \App\FoodIngredient;
use Carbon\Carbon;

class NutrientController extends Controller
{
    public static function getNutrients()
    {
        $auth = Auth::user();
        $meals = $auth->meals()->latest()->take(30)->get();

        $todaysEnergy = 0;
        $todaysProtein = 0;
        $todaysFat = 0;
        $todaysCarbon = 0;
        $todaysVitaminb1 = 0;
        $todaysVitaminc = 0;
        $todaysSalt = 0;
        $todaysDietaryFiber = 0;
        $todaysCalcium = 0;

        $today = Carbon::now()->format("Y-m-d");
        $todaysMeal = Meal::where('ate_at', "{$today}")->where('user_id', "{$auth->id}")->get();

        foreach ($todaysMeal as $meal) {
            $calculationQuantity = $meal->quantity/100;
            $todaysEnergy += ($meal->food_ingredient->energy_kcal * $calculationQuantity);
            $todaysProtein += ($meal->food_ingredient->protein * $calculationQuantity);
            $todaysFat += ($meal->food_ingredient->fat * $calculationQuantity);
            $todaysCarbon += ($meal->food_ingredient->carbon * $calculationQuantity);
            $todaysVitaminb1 += ($meal->food_ingredient->vitamin_b1 * $calculationQuantity);
            $todaysVitaminc += ($meal->food_ingredient->vitamin_c * $calculationQuantity);
            $todaysSalt += ($meal->food_ingredient->salt * $calculationQuantity);
            $todaysDietaryFiber += ($meal->food_ingredient->dietary_fiber * $calculationQuantity);
            $todaysCalcium += ($meal->food_ingredient->calcium * $calculationQuantity);
        }

        $yesterdaysEnergy = 0;
        $yesterdaysProtein = 0;
        $yesterdaysFat = 0;
        $yesterdaysCarbon = 0;
        $yesterdaysVitaminb1 = 0;
        $yesterdaysVitaminc = 0;
        $yesterdaysSalt = 0;
        $yesterdaysDietaryFiber = 0;
        $yesterdaysCalcium = 0;

        $yesterday = Carbon::now()->subDay()->format("Y-m-d");
        $yesterdaysMeal = Meal::where('ate_at', "{$yesterday}")->where('user_id', "{$auth->id}")->get();

        foreach ($yesterdaysMeal as $meal) {
            $calculationQuantity = $meal->quantity/100;
            $yesterdaysEnergy += $meal->food_ingredient->energy_kcal;
            $yesterdaysProtein += ($meal->food_ingredient->protein * $calculationQuantity);
            $yesterdaysFat += ($meal->food_ingredient->fat * $calculationQuantity);
            $yesterdaysCarbon += ($meal->food_ingredient->carbon * $calculationQuantity);
            $yesterdaysVitaminb1 += ($meal->food_ingredient->vitamin_b1 * $calculationQuantity);
            $yesterdaysVitaminc += ($meal->food_ingredient->vitamin_c * $calculationQuantity);
            $yesterdaysSalt += ($meal->food_ingredient->salt * $calculationQuantity);
            $yesterdaysDietaryFiber += ($meal->food_ingredient->dietary_fiber * $calculationQuantity);
            $yesterdaysCalcium += ($meal->food_ingredient->calcium * $calculationQuantity);
        }

        $twoDaysAgoEnergy = 0;
        $twoDaysAgoProtein = 0;
        $twoDaysAgoFat = 0;
        $twoDaysAgoCarbon = 0;
        $twoDaysAgoVitaminb1 = 0;
        $twoDaysAgoVitaminc = 0;
        $twoDaysAgoSalt = 0;
        $twoDaysAgoDietaryFiber = 0;
        $twoDaysAgoCalcium = 0;

        $twoDaysAgo = Carbon::now()->subDay(2)->format("Y-m-d");
        $twoDaysAgoMeal = Meal::where('ate_at', "{$twoDaysAgo}")->where('user_id', "{$auth->id}")->get();

        foreach ($twoDaysAgoMeal as $meal) {
            $calculationQuantity = $meal->quantity/100;
            $twoDaysAgoEnergy += ($meal->food_ingredient->energy_kcal * $calculationQuantity);
            $twoDaysAgoProtein += ($meal->food_ingredient->protein * $calculationQuantity);
            $twoDaysAgoFat += ($meal->food_ingredient->fat * $calculationQuantity);
            $twoDaysAgoCarbon += ($meal->food_ingredient->carbon * $calculationQuantity);
            $twoDaysAgoVitaminb1 += ($meal->food_ingredient->vitamin_b1 * $calculationQuantity);
            $twoDaysAgoVitaminc += ($meal->food_ingredient->vitamin_c * $calculationQuantity);
            $twoDaysAgoSalt += ($meal->food_ingredient->salt * $calculationQuantity);
            $twoDaysAgoDietaryFiber += ($meal->food_ingredient->dietary_fiber * $calculationQuantity);
            $twoDaysAgoCalcium += ($meal->food_ingredient->calcium * $calculationQuantity);
        }

        $threeDaysAgoEnergy = 0;
        $threeDaysAgoProtein = 0;
        $threeDaysAgoFat = 0;
        $threeDaysAgoCarbon = 0;
        $threeDaysAgoVitaminb1 = 0;
        $threeDaysAgoVitaminc = 0;
        $threeDaysAgoSalt = 0;
        $threeDaysAgoDietaryFiber = 0;
        $threeDaysAgoCalcium = 0;

        $threeDaysAgo = Carbon::now()->subDay(3)->format("Y-m-d");
        $threeDaysAgoMeal = Meal::where('ate_at', "{$threeDaysAgo}")->where('user_id', "{$auth->id}")->get();

        foreach ($threeDaysAgoMeal as $meal) {
            $calculationQuantity = $meal->quantity/100;
            $threeDaysAgoEnergy += ($meal->food_ingredient->energy_kcal * $calculationQuantity);
            $threeDaysAgoProtein += ($meal->food_ingredient->protein * $calculationQuantity);
            $threeDaysAgoFat += ($meal->food_ingredient->fat * $calculationQuantity);
            $threeDaysAgoCarbon += ($meal->food_ingredient->carbon * $calculationQuantity);
            $threeDaysAgoVitaminb1 += ($meal->food_ingredient->vitamin_b1 * $calculationQuantity);
            $threeDaysAgoVitaminc += ($meal->food_ingredient->vitamin_c * $calculationQuantity);
            $threeDaysAgoSalt += ($meal->food_ingredient->salt * $calculationQuantity);
            $threeDaysAgoDietaryFiber += ($meal->food_ingredient->dietary_fiber * $calculationQuantity);
            $threeDaysAgoCalcium += ($meal->food_ingredient->calcium * $calculationQuantity);
        }

        $fourDaysAgoEnergy = 0;
        $fourDaysAgoProtein = 0;
        $fourDaysAgoFat = 0;
        $fourDaysAgoCarbon = 0;
        $fourDaysAgoVitaminb1 = 0;
        $fourDaysAgoVitaminc = 0;
        $fourDaysAgoSalt = 0;
        $fourDaysAgoDietaryFiber = 0;
        $fourDaysAgoCalcium = 0;

        $fourDaysAgo = Carbon::now()->subDay(4)->format("Y-m-d");
        $fourDaysAgoMeal = Meal::where('ate_at', "{$fourDaysAgo}")->where('user_id', "{$auth->id}")->get();

        foreach ($fourDaysAgoMeal as $meal) {
            $calculationQuantity = $meal->quantity/100;
            $fourDaysAgoEnergy += ($meal->food_ingredient->energy_kcal * $calculationQuantity);
            $fourDaysAgoProtein += ($meal->food_ingredient->protein * $calculationQuantity);
            $fourDaysAgoFat += ($meal->food_ingredient->fat * $calculationQuantity);
            $fourDaysAgoCarbon += ($meal->food_ingredient->carbon * $calculationQuantity);
            $fourDaysAgoVitaminb1 += ($meal->food_ingredient->vitamin_b1 * $calculationQuantity);
            $fourDaysAgoVitaminc += ($meal->food_ingredient->vitamin_c * $calculationQuantity);
            $fourDaysAgoSalt += ($meal->food_ingredient->salt * $calculationQuantity);
            $fourDaysAgoDietaryFiber += ($meal->food_ingredient->dietary_fiber * $calculationQuantity);
            $fourDaysAgoCalcium += ($meal->food_ingredient->calcium * $calculationQuantity);
        }

        $fiveDaysAgoEnergy = 0;
        $fiveDaysAgoProtein = 0;
        $fiveDaysAgoFat = 0;
        $fiveDaysAgoCarbon = 0;
        $fiveDaysAgoVitaminb1 = 0;
        $fiveDaysAgoVitaminc = 0;
        $fiveDaysAgoSalt = 0;
        $fiveDaysAgoDietaryFiber = 0;
        $fiveDaysAgoCalcium = 0;

        $fiveDaysAgo = Carbon::now()->subDay(5)->format("Y-m-d");
        $fiveDaysAgoMeal = Meal::where('ate_at', "{$fiveDaysAgo}")->where('user_id', "{$auth->id}")->get();

        foreach ($fiveDaysAgoMeal as $meal) {
            $calculationQuantity = $meal->quantity/100;
            $fiveDaysAgoEnergy += ($meal->food_ingredient->energy_kcal * $calculationQuantity);
            $fiveDaysAgoProtein += ($meal->food_ingredient->protein * $calculationQuantity);
            $fiveDaysAgoFat += ($meal->food_ingredient->fat * $calculationQuantity);
            $fiveDaysAgoCarbon += ($meal->food_ingredient->carbon * $calculationQuantity);
            $fiveDaysAgoVitaminb1 += ($meal->food_ingredient->vitamin_b1 * $calculationQuantity);
            $fiveDaysAgoVitaminc += ($meal->food_ingredient->vitamin_c * $calculationQuantity);
            $fiveDaysAgoSalt += ($meal->food_ingredient->salt * $calculationQuantity);
            $fiveDaysAgoDietaryFiber += ($meal->food_ingredient->dietary_fiber * $calculationQuantity);
            $fiveDaysAgoCalcium += ($meal->food_ingredient->calcium * $calculationQuantity);
        }

        $sixDaysAgoEnergy = 0;
        $sixDaysAgoProtein = 0;
        $sixDaysAgoFat = 0;
        $sixDaysAgoCarbon = 0;
        $sixDaysAgoVitaminb1 = 0;
        $sixDaysAgoVitaminc = 0;
        $sixDaysAgoSalt = 0;
        $sixDaysAgoDietaryFiber = 0;
        $sixDaysAgoCalcium = 0;

        $sixDaysAgo = Carbon::now()->subDay(6)->format("Y-m-d");
        $sixDaysAgoMeal = Meal::where('ate_at', "{$sixDaysAgo}")->where('user_id', "{$auth->id}")->get();

        foreach ($sixDaysAgoMeal as $meal) {
            $calculationQuantity = $meal->quantity/100;
            $sixDaysAgoEnergy += ($meal->food_ingredient->energy_kcal * $calculationQuantity);
            $sixDaysAgoProtein += ($meal->food_ingredient->protein * $calculationQuantity);
            $sixDaysAgoFat += ($meal->food_ingredient->fat * $calculationQuantity);
            $sixDaysAgoCarbon += ($meal->food_ingredient->carbon * $calculationQuantity);
            $sixDaysAgoVitaminb1 += ($meal->food_ingredient->vitamin_b1 * $calculationQuantity);
            $sixDaysAgoVitaminc += ($meal->food_ingredient->vitamin_c * $calculationQuantity);
            $sixDaysAgoSalt += ($meal->food_ingredient->salt * $calculationQuantity);
            $sixDaysAgoDietaryFiber += ($meal->food_ingredient->dietary_fiber * $calculationQuantity);
            $sixDaysAgoCalcium += ($meal->food_ingredient->calcium * $calculationQuantity);
        }

        return [$meals, $today, $todaysEnergy, $todaysProtein, $todaysFat, $todaysCarbon, $todaysVitaminb1,
        $todaysVitaminc, $todaysSalt, $todaysDietaryFiber, $todaysCalcium, $yesterdaysEnergy, $yesterdaysProtein,
        $yesterdaysFat, $yesterdaysCarbon, $yesterdaysVitaminb1, $yesterdaysVitaminc, $yesterdaysSalt,
        $yesterdaysDietaryFiber, $yesterdaysCalcium, $twoDaysAgoEnergy, $twoDaysAgoProtein, $twoDaysAgoFat,
        $twoDaysAgoCarbon, $twoDaysAgoVitaminb1, $twoDaysAgoVitaminc, $twoDaysAgoSalt, $twoDaysAgoDietaryFiber,
        $twoDaysAgoCalcium, $threeDaysAgoEnergy, $threeDaysAgoProtein, $threeDaysAgoFat, $threeDaysAgoCarbon,
        $threeDaysAgoVitaminb1, $threeDaysAgoVitaminc, $threeDaysAgoSalt, $threeDaysAgoDietaryFiber,
        $threeDaysAgoCalcium, $fourDaysAgoEnergy, $fourDaysAgoProtein, $fourDaysAgoFat, $fourDaysAgoCarbon,
        $fourDaysAgoVitaminb1, $fourDaysAgoVitaminc, $fourDaysAgoSalt, $fourDaysAgoDietaryFiber, $fourDaysAgoCalcium,
        $fiveDaysAgoEnergy, $fiveDaysAgoProtein, $fiveDaysAgoFat, $fiveDaysAgoCarbon, $fiveDaysAgoVitaminb1,
        $fiveDaysAgoVitaminc, $fiveDaysAgoSalt, $fiveDaysAgoDietaryFiber, $fiveDaysAgoCalcium, $sixDaysAgoEnergy,
        $sixDaysAgoProtein, $sixDaysAgoFat, $sixDaysAgoCarbon, $sixDaysAgoVitaminb1, $sixDaysAgoVitaminc,
        $sixDaysAgoSalt, $sixDaysAgoDietaryFiber, $sixDaysAgoCalcium];
    }
}
