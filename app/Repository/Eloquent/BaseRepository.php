<?php

namespace App\Repository\Eloquent;

use App\Repository\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @return Post|null
     */
    public function byId($id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * @param array $content
     * @return Post
     */
    public function create($content): Model
    {
        return $this->model->create($content);
    }

    /**
     * @param $id
     * @param $content
     * @return Post
     */
    public function update($id, $content): Model
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
