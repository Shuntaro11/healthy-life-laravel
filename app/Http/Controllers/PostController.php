<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Post;
use \App\Tag;
use Storage;

class PostController extends Controller
{
    public function index()
    {
        $q = \Request::query();

        if(isset($q['name'])){

            $posts = Post::latest()->where('content', "like", "%#{$q['name']}%")->paginate(5);
            $name = $q['name'];
            $search_result = 'タグ： #' . $q['name'] . ' '. 'のレシピ' . ' ' . $posts->total() . ' ' . '件';
            return view('post.index', compact('posts', 'name', 'search_result'));

        }else {
            $search_result = '新着レシピ！！';
            $posts = Post::latest()->paginate(5);
            return view('post.index', compact('posts', 'search_result'));
        }

    }

    public function create()
    {
        if ( Auth::check() ) {
            
            return view('post.create');

        } else {
          
            return redirect('/');
        }
        
    }

    public function store(Request $request)
    {
        if ( Auth::check() ) {
            
            $validator = $request->validate([
                'title' => ['required', 'string', 'max:30'],
                'image' => ['required', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
                'content' => ['required', 'string', 'max:2000'],
            ]);
            
            $image = $request->file('image'); //本番用
            $path = Storage::disk('s3')->put('/', $image, 'public'); //本番用
            // $path = $request->file('image')->store('public/img'); //ローカル用
    
            preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $request->content, $match);
            
            $tags = [];
            foreach ($match[1] as $tag) {
                $found = Tag::firstOrCreate(['name' => $tag]);
    
                array_push($tags, $found);
            }
    
            $tag_ids = [];
    
            foreach ($tags as $tag){
                array_push($tag_ids, $tag['id']);
            }
    
            $post = new Post;
            $post->user_id = Auth::user()->id;
            $post->title = $request->title;
            // $post->image = basename($path); //ローカル用
            $post->image = Storage::disk('s3')->url($path); //本番用
            $post->content = $request->content;
            
            $post->save();
            $post->tags()->attach($tag_ids);
            
            return redirect('/');

        } else {
          
            return redirect('/');
        }
        
    }

    public function show(Post $post)
    {
        if ( Auth::check() ) {
            $defaultCount = count($post->likes);

            $defaultLiked = $post->likes->where('user_id', Auth::user()->id)->first();
            if(isset($defaultLiked)){
                $defaultLiked == false;
            } else {
                $defaultLiked == true;
            }

            return view('post.show', compact('post', 'defaultCount', 'defaultLiked'));

          } else {
          
            return view('post.show', compact('post'));
          }
    }

    public function edit(Post $post){
        
        if ( Auth::check() ) {
            
            return view('post.edit', compact('post'));

        } else {
          
            return redirect('/');
        }
    }

    public function update(Request $request, Post $post){

        $validator = $request->validate([
            'title' => ['required', 'string', 'max:30'],
            'image' => ['file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'content' => ['required', 'string', 'max:2000'],
        ]);

        if(!empty($request['image'])){

            // Storage::delete('public/img/' . basename($post->image)); //ローカル
            Storage::disk('s3')->delete(basename($post->image)); //本番

            $image = $request->file('image'); //本番用
            $path = Storage::disk('s3')->put('/', $image, 'public'); //本番用
            // $path = $request->file('image')->store('public/img'); //ローカル用
            
            $post->title = $request->title;
            // $post->image = basename($path); //ローカル用
            $post->image = Storage::disk('s3')->url($path); //本番用
            $post->content = $request->content;
        }else{
            $post->title = $request->title;
            $post->content = $request->content;
        }

        $post->tags()->delete();

        preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $request->content, $match);
        
        $tags = [];
        foreach ($match[1] as $tag) {
            $found = Tag::firstOrCreate(['name' => $tag]);
            array_push($tags, $found);
        }

        $tag_ids = [];
        foreach ($tags as $tag){
            array_push($tag_ids, $tag['id']);
        }

        $post->save();
        $post->tags()->attach($tag_ids);

        $defaultCount = count($post->likes);

        $defaultLiked = $post->likes->where('user_id', Auth::user()->id)->first();
        if(isset($defaultLiked)){
            $defaultLiked == false;
        } else {
            $defaultLiked == true;
        }

        return view('post.show', compact('post', 'defaultCount', 'defaultLiked'));
    }

    public function destroy (Post $post)
    {
        Post::destroy($post->id);
        // Storage::delete('public/img/' . basename($post->image)); //ローカル
        Storage::disk('s3')->delete(basename($post->image)); //本番

        return redirect('/');
    }

    public function search(Request $request)
    {

        $posts = Post::latest()->where('title', 'like', "%{$request->search}%")
                ->orWhere('content', 'like', "%{$request->search}%")
                ->paginate(5);

        $search_query = $request->search;
        $search_result = '"' . $request->search . '" ' . 'の検索結果' . ' ' . $posts->total() . ' ' .'件';

        return view('post.index', compact('posts', 'search_result', 'search_query'));
    }
}