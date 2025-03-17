<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class HomeController extends Controller
{
    public function home(){
        return view('layout.User.home');
    }

    public function help(){
        return view('layout.User.help');
    }

    public function features(){
        return view('layout.User.features');
    }

    public function blogDetails($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail(); // Fetch post by slug
    
        return view('layout.User.blog_details', compact('post'));
    }
    
    public function blog(){
        $categories = Category::all();
        $posts = Post::with('category')->latest()->get();
        return view('layout.User.blog',compact('posts','categories'));
    }
}
