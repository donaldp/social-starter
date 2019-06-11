<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CreateNewPostRequest;

class PostController extends Controller
{
  /**
   * Add post (message)
   *
   * @param CreateNewPostRequest $request
   * @return JsonResponse
   */
  public function create(CreateNewPostRequest $request) : JsonResponse
  {
    return response()->json([
      'status' => 'success',
      'post' => Post::with('user')->where('id', $request->addPost()->id)->first()
    ]);
  }
}
