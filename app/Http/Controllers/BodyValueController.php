<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\BodyValue;

class BodyValueController extends Controller
{

    public function store(Request $request)
    {
        $validator = $request->validate([
            'date' => ['required', 'date'],
            'weight' => ['required', 'numeric'],
            'height' => ['required', 'numeric'],
        ]);

        $bmi = round($request->weight / (( $request->height / 100 ) * ( $request->height / 100 )), 1);

        $body_values = new BodyValue;
        $body_values->date = $request->date;
        $body_values->weight = $request->weight;
        $body_values->height = $request->height;
        $body_values->bmi = $bmi;
        $body_values->user_id = Auth::user()->id;
        
        $body_values->save();

        $auth = Auth::user();
        $body_values = $auth->body_values()->latest()->take(14)->get();

        $days = array();
        $bmis = array();
        
        foreach ($body_values as $value) {
            array_push($days,$value->date);
            array_push($bmis,$value->bmi);
        }
        
        return back();
    }
    
}
