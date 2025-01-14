<?php

namespace App\Repositories;

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

            if (!$updated) { // if updating fails
                throw new \Exception('Failed to update post!');
            }

            if ($user_ids = data_get($attributes, 'user_ids')) {
                $post->users()->sync($user_ids);
            }

            return $post;
        });
    }

    public function forceDelete($post)
    {
        return DB::transaction(function () use ($post) {
            $deleted = $post->forceDelete();

            if (!$deleted) {
                throw new \Exception('Cannot delete post');
            }

            return $deleted;
        });
    }
}
