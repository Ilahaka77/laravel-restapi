<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $data = Post::all();

        return response()->json($data, 200);
    }

    public function show($id)
    {
        $data = Post::find($id);
        if(is_null($data)){
            return response()->json([
                'message' => 'Resource not found'
            ], 404);
        }
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data,[
            'title' => ['required', 'min:5']
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()
            ]);
        }

        Post::create($data);
        return response()->json('success', 201);
    }

    public function update(Request $request, Post $post)
    {
        $post->update($request->all());
        return response()->json($post, 200);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json('delete success', 200);
    }
}
