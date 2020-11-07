<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Repository\PostRepositoryInterface;

class PostControllerTest extends TestCase
{
    public static function tearDownAfterClass(): void
    {
        \Mockery::close();
    }

    public function testCreatePost(): void
    {
        $this->doMock('create', true);

        $response = $this->post('/api/posts');
        $response->assertStatus(201)
                 ->assertJson($this->getPost()->toArray());
    }

    public function testGetExistingPost(): void
    {
        $this->doMock('byId', true);

        $response = $this->get('/api/posts/1');
        $response->assertStatus(200)
                 ->assertJson($this->getPost()->toArray());
    }

    public function testGetNonExistentPost(): void
    {
        $this->doMock('byId', false);

        $response = $this->get('/api/posts/22');
        $response->assertStatus(404);
    }

    public function testUpdateExistingPost(): void
    {
        $this->doMock('update', true);

        $response = $this->patch('/api/posts/1');
        $response->assertStatus(200)
            ->assertJson($this->getPost()->toArray());
    }

    public function testUpdateNonExistentPost(): void
    {
        $this->doMock('update', false);

        $response = $this->patch('/api/posts/22');
        $response->assertStatus(404);
    }

    public function testDeletePost(): void
    {
        $this->doMock('delete', false);

        $response = $this->delete('/api/posts/1');
        $response->assertNoContent();
    }


    public function testDeleteNonExistentPost(): void
    {
        $this->mock(PostRepositoryInterface::class, function ($mock) {
            $mock->shouldReceive('delete')->andThrow(new \Exception);;
        });

        $response = $this->delete('/api/posts/1');
        $response->assertStatus(404);
    }

    /**
     * Set up a mock for the test case
     * @param $methodName
     * @param $shouldReturnModel
     */
    private function doMock($methodName, $shouldReturnModel): void
    {
        $model = $shouldReturnModel ? $this->getPost() : null;
        $this->mock(PostRepositoryInterface::class, function ($mock) use ($model, $methodName) {
            $mock->shouldReceive([
                $methodName => $model,
            ]);
        });
    }

    /**
     * Return a new post
     * @return Post
     */
    private function getPost(): Post
    {
        return new Post([
            'title' => 'Test post',
            'author' => 'Jim',
            'content' => 'My post content'
        ]);
    }
}
