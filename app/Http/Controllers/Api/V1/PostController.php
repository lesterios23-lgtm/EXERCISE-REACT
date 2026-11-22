<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Post::with('user')->latest()->get(),
        ]);
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        $post = Post::create([
            'user_id' => $request->user()?->id,
            'message' => $request->validated('message'),
        ]);

        return response()->json([
            'data' => $post->load('user'),
        ], 201);
    }

    public function show(Post $post): JsonResponse
    {
        return response()->json([
            'data' => $post->load('user'),
        ]);
    }

    public function update(StorePostRequest $request, Post $post): JsonResponse
    {
        $post->update([
            'message' => $request->validated('message'),
        ]);

        return response()->json([
            'data' => $post->load('user'),
        ]);
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json(null, 204);
    }
}
