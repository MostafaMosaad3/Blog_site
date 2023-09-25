<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User ;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->with('categories');

        if (request('search')) {
            $posts = $posts->where('title', 'like', '%' . request('search') . '%');

        }
        $posts = $posts->latest()->paginate(2);

        return view('home', compact('posts'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create' , compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
//        dd($request->all());
        $ImageName= time().'.'.$request->file('image')->getClientOriginalExtension() ;
        $request->file('image')->move( public_path('storage/posts') , $ImageName);
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content ,
            // auth()->user()->id
            'user_id' => auth()->id(),
            'image' =>$ImageName
        ]);
        $post->categories()->attach($request->categories);
        return redirect()->route('home')->with('success', 'Post Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $SelectedCategories= $post->categories()->pluck('categories.id')->toArray();
        return view('posts.edit' , compact('categories' ,'SelectedCategories' , 'post')) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Post $post)
    {
        if($request->hasFile('image')){
            if(file_exists(public_path($post->image_path))){
                unlink(public_path($post->image_path));
            }
            $ImageName=time() . '.' .$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('storage/posts') , $ImageName);
        }
        $post->update([
            'title' => $request->title,
            'content' => $request->content ,
            'user_id' => auth()->id(),
            'image' =>$ImageName ?? $post->image
        ]);

        $post->categories()->sync($request->categories);
        return redirect()->route('profile.index')->with('success' , 'post updated successfully');
//
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if(file_exists(public_path($post->image_path))){
            unlink(public_path($post->image_path));
        }
        $post->categories()->detach();
        $post->delete();
        return redirect()->route('profile.index')->with('success' , 'post deleted successfully');
    }
}
