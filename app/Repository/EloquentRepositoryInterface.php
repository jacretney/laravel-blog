<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{
    /**
     * @param $id
     * @return Post|null
     */
    public function byId($id): ?Model;

    /**
     * @param $content
     * @return mixed
     */
    public function create($content): Model;

    /**
     * @param $id
     * @param $content
     * @return Post
     */
    public function update($id, $content): Model;

    /**
     * @param $id
     * @return bool
     */
    public function delete($id): bool;
}
