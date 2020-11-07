<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repository\PostRepositoryInterface;

class PostController extends Controller
{
    /**
     * @var PostRepositoryInterface
     */
    private PostRepositoryInterface $postRepository;

    /**
     * PostController constructor.
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $content = json_decode($request->getContent(), true);
        $post = $this->postRepository->create($content);

        return new Response($post, 201);
    }

    /**
     * Display the specified resource
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $post = $this->postRepository->byId($id);
        if (!$post) {
            return new Response([ "error" => "Post not found" ], 404);
        }

        return new Response($post, 200);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $post = $this->postRepository->byId($id);

        if ($post) {
            $content = json_decode($request->getContent(), true);
            $post = $this->postRepository->update($id, $content);
            return new Response($post, 200);
        }

        return new Response([ "error" => "Post not found" ], 404);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $post = $this->postRepository->byId($id);

        if ($post) {
            $this->postRepository->delete($id);
            return new Response([], 204);
        }

        return new Response([ "error" => "Post not found" ], 404);
    }
}
