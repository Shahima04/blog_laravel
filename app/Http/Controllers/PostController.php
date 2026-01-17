<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() //displays all the records 
    {
        $posts = Post::with(['author', 'category', 'comments', 'tags'])->paginate(10);  //records are assigned to a variable
        return PostResource::collection($posts);    //records are returned through the variable
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'post_type' => 'nullable|string|max:50',
            'meta_data' => 'nullable|json',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:users,id',
        ]);

        $post = Post::create($validated);
        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with(['author','category','comments','tags'])->findOrFail($id);
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'post_type' => 'nullable|string|max:50',
            'meta_data' => 'nullable|json',
        ]);

        $post = Post::findOrFail($id);
        $post->update($validated);

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'],200);
    }
}
