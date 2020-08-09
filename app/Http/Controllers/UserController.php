<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\User;
use Storage;

class UserController extends Controller
{

    public function show($id)
    {
        $user = User::find($id);
        $user_posts = $user->posts()->latest()->get();
        return view('user.show', compact('user', 'user_posts'));
    }

    public function edit(){

        if ( Auth::check() ) {
            
            $auth = Auth::user();
            return view('user.edit', compact('auth'));

        } else {
          
            return redirect('/');
        }
    }

    public function update(Request $request){

        $user = Auth::user();

        if($request->email === $user->email){
            
            $validator = $request->validate([
                'name' => ['required', 'string', 'max:20'],
                'user_image' => ['file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            ]);
    
            
    
            if(!empty($request['user_image'])){
    
                // Storage::delete('public/img/' . basename($user->user_image)); //ローカル
                Storage::disk('s3')->delete(basename($user->user_image)); //本番
    
                // $path = $request['user_image']->store('public/img'); //ローカル
                $image = $request['user_image']; //本番用
                $path = Storage::disk('s3')->put('/', $image, 'public'); //本番用
    
                $user->name = $request->name;

                // $user->user_image = basename($path); //ローカル用
                $user->user_image = Storage::disk('s3')->url($path); //本番用
    
            }else{
    
                $user->name = $request->name;

            }
    
            $user->save();

        }else{
            $validator = $request->validate([
                'name' => ['required', 'string', 'max:20'],
                'user_image' => ['file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
    
            
    
            if(!empty($request['user_image'])){
    
                // Storage::delete('public/img/' . basename($user->user_image)); //ローカル
                Storage::disk('s3')->delete(basename($user->user_image)); //本番
    
                // $path = $request['user_image']->store('public/img'); //ローカル
                $image = $request['user_image']; //本番用
                $path = Storage::disk('s3')->put('/', $image, 'public'); //本番用
    
                $user->name = $request->name;
                $user->email = $request->email;
                // $user->user_image = basename($path); //ローカル用
                $user->user_image = Storage::disk('s3')->url($path); //本番用
    
            }else{
    
                $user->name = $request->name;
                $user->email = $request->email;
            }
    
            $user->save();
        }



        $user_posts = $user->posts()->latest()->get();
        return view('user.show', compact('user', 'user_posts'));
    }

    public function destroy ()
    {
        $auth = Auth::user();
        // Storage::delete('public/img/' . basename($auth->user_image)); //ローカル
        Storage::disk('s3')->delete(basename($auth->user_image)); //本番

        $auth_posts = $auth->posts()->get();
        foreach ($auth_posts as $post) {
            Storage::disk('s3')->delete(basename($post->image)); //本番
        }

        User::destroy($auth->id);

        return redirect('/');
    }

    public function confirm ()
    {
        if ( Auth::check() ) {

            return redirect('/');

        }
        
        return view('user.confirm');
    }
}
