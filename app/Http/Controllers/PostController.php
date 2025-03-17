<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'content' => 'required',
            'category_id' => 'required',
            'image' => 'required|image',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            // Handle Image Upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('postimage', $imageName, 'public');
            }

            Post::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'category_id' => $request->category_id,
                'meta_title' => $request->meta_title ?? $request->title,
                'meta_description' => $request->meta_description ?? Str::limit(strip_tags($request->content), 160),
                'image' => $imagePath,
            ]);

            DB::commit(); // Commit the transaction
            return redirect()->route('posts.index')->with('success', 'Post has been created successfully');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback on failure
            dd($e);
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong! Please try again. Error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255|unique:posts,title,' . $post->id,
            'content' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    
        DB::beginTransaction();
        try {
            // Handle Image Upload
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($post->image) {
                    Storage::disk('public')->delete($post->image);
                }
    
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('postimage', $imageName, 'public');
                $post->image = $imagePath;
            }
    
            // Update post data
            $post->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'category_id' => $request->category_id,
                'meta_title' => $request->meta_title ?? $request->title,
                'meta_description' => $request->meta_description ?? Str::limit(strip_tags($request->content), 160),
            ]);
    
            DB::commit(); // Commit the transaction
            return redirect()->route('posts.index')->with('success', 'Post has been updated successfully');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback on failure
            return redirect()->back()->withInput()->with('error', 'Something went wrong! Please try again. Error: ' . $e->getMessage());
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}
