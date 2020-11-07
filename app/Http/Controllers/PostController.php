<?php

namespace App\Http\Controllers;

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

        return new Response($post);
    }

    /**
     * Display the specified resource
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $post = $this->postRepository->byId($id);
        return new Response($post);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $content = json_decode($request->getContent(), true);
        $post = $this->postRepository->update($id, $content);

        return new Response($post);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->postRepository->delete($id);
        return new Response([]);
    }
}
