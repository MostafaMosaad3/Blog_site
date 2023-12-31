<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $categories = Category::all();

        $name = Auth::user()->name;
        $posts = Post::with('user')->with('categories')->where('user_id', auth()->id())
            ->latest()->paginate(2);

        if (request('search')) {
            $posts = Post::with('user')->with('categories')->where('user_id', auth()->id())->
            where('title', 'like', '%' . request('search') . '%')
                ->latest()->paginate(2);

            return view('website.profile', compact('posts', 'name'));
//
        }
        else
        {
            return view('website.profile', compact('posts', 'name'));
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
