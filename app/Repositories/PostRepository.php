<?php

namespace App\Repositories;

use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Interfaces\PostInterface;
use App\Models\Post;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class PostRepository implements PostInterface {
    public function getAllPosts()
    {
        $posts = Post::all();

        return $posts;
    }

    public function getSpecificPost($post)
    {
        try{
            $data = Post::find($post);
            return $data;
        }catch(ModelNotFoundException $e){
            return $e;
        }
    }

    public function addPost(array $post)
    {
        $data = new Post;

        return $data->create($post);
    }

    public function updatePost($post, array $updatedPost)
    {
        Post::whereIn('id', $post)->update([
            'title' => $updatedPost['title'],
            'description' => $updatedPost['description']
        ]);

        $newPost = Post::find($post);

        return new PostResource([
            'data' => $newPost
        ]);
    }

    public function deletePost($post)
    {
        Post::whereIn('id', $post)->delete();
    }
}