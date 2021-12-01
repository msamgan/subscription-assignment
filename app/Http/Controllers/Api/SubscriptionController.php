<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Exception;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
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
            'email' => ['required'],
        ]);

        if ($validation->fails()) {
            return [
                'status' => false,
                'message' => $validation->getMessageBag()
            ];
        }

        try {
            Subscriber::updateOrCreate([
                'website_id' => request('website_id'),
                'email' => request('email'),
            ], [
                'name' => request('name')
            ]);

            return [
                'status' => true,
                'message' => 'Subscriber created.'
            ];
        } catch (Exception $exception) {
            return [
                'status' => false,
                'message' => $exception->getMessage()
            ];
        }
    }
}
