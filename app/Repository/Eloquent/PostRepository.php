<?php

namespace App\Repository\Eloquent;

use App\Repository\PostRepositoryInterface;
use App\Models\Post;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    /**
     * PostRepository constructor.
     * @param Post $model
     */
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $id
     * @return Post|null
     */
    public function byId($id): ?Post
    {
        return $this->model->find($id);
    }

    /**
     * @param array $content
     * @return Post
     */
    public function create($content): Post
    {
        return $this->model->create($content);
    }

    /**
     * @param $id
     * @param $content
     * @return Post
     */
    public function update($id, $content): Post
    {
        $this->byId($id)->update($content);
        return $this->byId($id);
    }

    /**
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public function delete($id): bool
    {
        return $this->byId($id)->delete();
    }
}
