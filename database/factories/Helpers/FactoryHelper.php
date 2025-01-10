<?php

namespace Database\Factories\Helpers;

class FactoryHelper
{
    /**
     * This function will get a random model id from the database
     * @param string | HasFactory $model
     */

    public static function getRandomModelId(string $model)
    {
        // get model count (Posts)
        $count = $model::query()->count();

        if ($count === 0) {
            // if model count is 0, we create a new Post record
            $postId = $model::factory()->create()->id;
            return $postId;
        } else {
            // generate random number between 1 and model count
            $postId = rand(1, $count);
            return $postId;
        }
    }
}
