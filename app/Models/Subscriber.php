<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @method static updateOrCreate(array $array, array $array1)
 */
class Subscriber extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['website_id', 'name', 'email'];

    /**
     * @param $websiteId
     * @return Builder[]|Collection
     */
    public static function byWebsite($websiteId)
    {
        return Subscriber::query()->where('website_id', $websiteId)->get();
    }

    public function notify()
    {
        
    }
}
