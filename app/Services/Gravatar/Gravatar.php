<?php

namespace App\Services\Gravatar;

class Gravatar
{
  /**
   * Get user's gravatar
   *
   * @param string $email
   * @param int|null $size
   * @return string
   */
  public static function make(string $email, ?int $size = 50) : string
  {
    return config('services.gravatar.url') . md5(strtolower(trim($email))) . "&s=" . $size;
  }
}
