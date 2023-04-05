<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::select('title', 'slug', 'content')->get();
        
        return response()->json(['data' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:150',
            'content' => 'required|string|escape'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $post = Post::create([
                'user_id' => auth()->user()->id,
                'title' => $request->input('title'),
                'slug' => Str::slug($request->input('title')),
                'content' => $request->input('content'),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Post could not be created'], 500);
        }

        return response()->json(['message' => 'Post created successfully', 'data' => $post]);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:150',
            'content' => 'required|string|escape'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user_id = auth()->user()->id;

        try {
            $post = Post::findOrFail($id);

            if ($post->user_id === $user_id) {
                $post->update([
                    'user_id' => $user_id,
                    'title' => $request->input('title'),
                    'slug' => Str::slug($request->input('title')),
                    'content' => $request->input('content'),
                ]);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => 'Post could not be updated'], 500);
        }

        return response()->json(['message' => 'Post updated successfully', 'data' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ids = json_decode($request->ids);

        Post::whereIn('id', $ids)->delete();

        return response()->json(['message' => count($ids) > 1 ? 'Posts' : 'Post' . ' deleted successfully']);
    }
}
