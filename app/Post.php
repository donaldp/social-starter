<?php

namespace App;

use Hashids;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id', 'hashid', 'body',
  ];

  /**
   * Get owner of the post
   *
   * @return Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user()
  {
    return $this->belongsTo(User::class)->select(['id', 'name', 'email']);
  }

  /**
   * Add a new post
   *
   * @param array $data
   * @return Post
   */
  public static function add(array $data) : Post
  {
    $post = Post::create($data);

    $post->hashid = Hashids::encode($post->id);

    $post->save();

    return $post;
  }
}
