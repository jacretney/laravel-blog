<?php

namespace App\Repository;

use App\Models\Post;

interface PostRepositoryInterface
{
    /**
     * @param $id
     * @return Post|null
     */
    public function byId($id): ?Post;

    /**
     * @param $content
     * @return mixed
     */
    public function create($content): Post;

    /**
     * @param $id
     * @param $content
     * @return Post
     */
    public function update($id, $content): Post;

    /**
     * @param $id
     * @return bool
     */
    public function delete($id): bool;
}
