<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Post\StoreRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        if(!empty($data['image'])) {
            $path = Storage::disk('local')->put('/images', $data['image']);
            $data['image_url'] = $path;
        }

        unset($data['image']);
        $post = Post::create($data);

        return PostResource::make($post)->resolve();
    }
}
