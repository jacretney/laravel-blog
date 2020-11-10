<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Repository\PostRepositoryInterface;

class PostViewController extends Controller
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
     * Display a listing of posts.
     * @return View
     */
    public function index()
    {
        return view('pages.posts');
    }

    /**
     * Show the form for creating a new post.
     * @return View
     */
    public function create()
    {
        return view('pages.createPost');
    }

    /**
     * Show the reading view for a post.
     * @param integer $id
     * @return View
     */
    public function show($id): View
    {
        $post = $this->postRepository->byId($id);

        if (!$post) {
            return view ('pages.404');
        }

        return view('pages.post', [
            'postTitle' => $post['title'],
            'postContent' => $post['content']
        ]);
    }

    /**
     * Show the form for editing a post.
     * @param integer $id
     * @return View
     */
    public function edit($id): View
    {
        $post = $this->postRepository->byId($id);

        if (!$post) {
            return view ('pages.404');
        }

        return view('pages.post', [
            'postTitle' => $post['title'],
            'postContent' => $post['content']
        ]);
    }
}
