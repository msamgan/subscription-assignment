<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class PostNotificationTrack extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['post_id', 'subscriber_id'];

    /**
     * @param $postId
     * @param $subscriberId
     * @return bool
     */
    public static function check($postId, $subscriberId): bool
    {
        return PostNotificationTrack::query()
            ->where('post_id', $postId)
            ->where('subscriber_id', $subscriberId)
            ->exists();
    }
}
