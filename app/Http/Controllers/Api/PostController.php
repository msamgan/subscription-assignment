<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Subscriber;
use App\Notifications\PostPublished;
use Exception;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * @return array
     */
    public function store(): array
    {
        $validation = Validator::make(request()->all(), [
            'website_id' => 'required',
            'name' => ['required'],
            'description' => ['required'],
        ]);

        if ($validation->fails()) {
            return [
                'status' => false,
                'message' => $validation->getMessageBag()
            ];
        }

        try {
            $post = Post::create([
                'website_id' => request('website_id'),
                'name' => request('name'),
                'description' => request('description')
            ]);

            foreach (Subscriber::byWebsite(request('website_id')) as $subscriber) {
                Notification::send($subscriber, new PostPublished($post));
            }

            return [
                'status' => true,
                'message' => 'Post created.'
            ];
        } catch (Exception $exception) {
            return [
                'status' => false,
                'message' => $exception->getMessage()
            ];
        }
    }
}
