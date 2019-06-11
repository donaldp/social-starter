<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CreateNewPostRequest;
use Illuminate\Database\Eloquent\Collection;

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

  /**
   * Get all posts
   *
   * @return \Illuminate\Database\Eloquent\Collection
   */
  public function all() : Collection
  {
    return Post::with('user')
                ->orderBy('id', 'desc')
                ->limit(4)
                ->get();
  }

  /**
   * Get older posts (messages)
   *
   * @param Request $request
   * @return \Illuminate\Database\Eloquent\Collection
   */
  public function getOlder(Request $request) : Collection
  {
    return Post::with('user')
                ->orderBy('id', 'desc')
                ->where('id', '<', $request->id)
                ->take(4)
                ->get();
  }
}
