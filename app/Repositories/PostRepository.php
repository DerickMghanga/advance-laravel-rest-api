<?php

namespace App\Repositories;

use App\Exceptions\GeneralJsonException;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostRepository extends BaseRepository
{
    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes) {
            $created = Post::query()->create([
                'title' => data_get($attributes, 'title', 'Untitled'),
                'body' => data_get($attributes, 'body'),
            ]);

            // if (!$created) {
            //     throw new GeneralJsonException('Failed to create post!', 422);
            // }

            throw_if(!$created, GeneralJsonException::class, "Failed to create post!");

            $user_ids = data_get($attributes, 'user_ids');

            if ($user_ids) {
                $created->users()->sync($user_ids);
            }

            return $created;
        });
    }

    public function update($post, array $attributes)
    {
        return DB::transaction(function () use ($post, $attributes) {
            $updated = $post->update([
                "title" => data_get($attributes, 'title'),
                "body" => data_get($attributes, 'body'),
            ]);  // $updated returns True or False

            throw_if(!$updated, GeneralJsonException::class, "Failed to update post!");

            if ($user_ids = data_get($attributes, 'user_ids')) {
                $post->users()->sync($user_ids);
            }

            return $post;
        });
    }

    public function forceDelete($post)
    {
        return DB::transaction(function () use ($post) {
            $deleted = $post->forceDelete();  // returns a boolean

            throw_if(!$deleted, GeneralJsonException::class, "Failed to delete post!");

            return $deleted;
        });
    }
}
