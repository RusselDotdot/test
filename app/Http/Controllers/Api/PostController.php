<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repositories\PostRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    protected PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postRepository->getAllPosts();

        return new PostResource([
            'status' => true,
            'data' => $posts,
            'message' => 'Ok'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        // dd($request->all());
        // $post = Post::create($request->all());

        // return response()->json([
        //     'status' => true,
        //     'message' => "Post Created Successfully",
        //     'post' => $post
        // ], 200);

        try{
            DB::beginTransaction();
            $data = $this->postRepository->addPost($request->all());

            DB::commit();
            return new PostResource([
                'status' => true,
                'data' => $data,
                'message' => 'Ok'
            ]);
        }catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $posts = $this->postRepository->getSpecificPost($post);
        return new PostResource([
            'status' => true,
            'data' => $posts,
            'message' => 'Ok'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $post->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Post Updated Successfully",
            'post' => $post
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'status' => true,
            'message' => "Post Deleted Successfully",
            'post' => $post
        ], 200);
    }
}
