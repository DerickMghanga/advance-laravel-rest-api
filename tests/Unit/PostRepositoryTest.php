<?php

namespace Tests\Unit;

use App\Exceptions\GeneralJsonException;
use App\Models\Post;
use App\Repositories\PostRepository;
use Tests\TestCase;

class PostRepositoryTest extends TestCase
{

    public function test_create()
    {
        // 1. define the goal

        // 2. replicate the env / restriction
        $repository = $this->app->make(PostRepository::class);

        // 3. define the source of truth
        $payload = [
            'title' => 'heyaa',
            'body' => []
        ];

        // 4. compare the result
        $result = $repository->create($payload);

        $this->assertSame($payload['title'], $result->title, 'Post created does not have the same title');
    }
    public function test_update()
    {
        // 1. define the goal

        // 2. replicate the env / restriction
        $repository = $this->app->make(PostRepository::class);

        $dummyPost = Post::factory(1)->create()[0];

        // 3. define the source of truth
        $payload = [
            'title' => 'abcd5',
        ];

        // 4. compare the result
        $updated = $repository->update($dummyPost, $payload);

        $this->assertSame($payload['title'], $updated->title, 'Post updated does not have the same title');
    }

    public function test_delete_will_throw_exception_when_delete_post_that_doesnt_exist()
    {
        // 1. define the goal

        // 2. replicate the env / restriction
        $repository = $this->app->make(PostRepository::class);
        $dummy = Post::factory(1)->make()->first();

        $this->expectException(GeneralJsonException::class);
        $deleted = $repository->forceDelete($dummy);
    }

    public function test_delete()
    {
        // 1. define the goal

        // 2. replicate the env / restriction
        $repository = $this->app->make(PostRepository::class);
        $dummy = Post::factory(1)->create()->first();

        // 3. compare the result
        $deleted = $repository->forceDelete($dummy);

        // find from the DB if the record was indeed deleted
        $found = Post::query()->find($dummy->id);

        $this->assertSame(null, $found, 'Post was NOT deleted');
    }
}

// test('example', function () {
//     expect(true)->toBeTrue();
// });
