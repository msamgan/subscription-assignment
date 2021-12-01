<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static updateOrCreate(array $array, array $array1)
 */
class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = ['website_id', 'name', 'email'];
}
