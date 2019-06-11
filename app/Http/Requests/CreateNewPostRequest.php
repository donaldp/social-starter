<?php

namespace App\Http\Requests;

use Auth;
use App\Post;
use Illuminate\Foundation\Http\FormRequest;

class CreateNewPostRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'message' => 'required|min:10'
    ];
  }

  /**
   * Add post (message)
   *
   * @return Post
   */
  public function addPost() : Post
  {
    return Post::add([
      'user_id' => Auth::id(),
      'body' => $this->message
    ]);
  }
}
