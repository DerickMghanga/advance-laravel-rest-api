<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $posts = Post::query()->where('id', '=', '1')->get();
        $posts = Post::query()->get();

        return new JsonResponse([
            'data' => $posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $created = Post::query()->create([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return new JsonResponse([
            'data' => $created
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new JsonResponse([
            'data' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // $updated = $post->update($request->only(['title', 'body']));

        $updated = $post->update([
            "title" => $request->title ?? $post->title,
            "body" => $request->body ?? $post->body,
        ]);  // $updated returns True or False

        if (!$updated) {
            return new JsonResponse([
                'errors' => "Failed to update model."
            ], 400);
        }

        return new JsonResponse([
            "data" => $post
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $deleted = $post->forceDelete();

        if (!$deleted) {
            return new JsonResponse([
                'errors' => 'Could not delete the model'
            ], 400);
        }

        return new JsonResponse([
            'data' => "Post deleted successfully!"
        ]);
    }
}
