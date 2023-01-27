<?php

namespace App\Repositories;

use App\Http\Requests\StorePostRequest;
use App\Interfaces\PostInterface;
use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\DB;

class PostRepository implements PostInterface {
    public function getAllPosts()
    {
        $posts = Post::all();

        return $posts;
    }

    public function getSpecificPost($post)
    {
        $posts = Post::find($post);

        return $posts;
    }

    public function addPost(array $data)
    {
        $post = new Post;

        return $post->create($data);
    }
}