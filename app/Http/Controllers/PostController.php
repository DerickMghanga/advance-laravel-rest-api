<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repositories\PostRepository;
use App\Rules\IntegerArray;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * @group Post Management
 * APIs to manage post.
*/

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * Gets a list of posts.
     *
     * @queryParam page_size int Size per page. Defaults to 20. Example: 20
     * @queryParam page int Page to view. Example: 1
     *
     * @apiResourceCollection App\Http\Resources\PostResource
     * @apiResourceModel App\Models\Post
     * @return ResourceCollection
     * 
     */
    public function index(Request $request)
    {
        // report(GeneralJsonException::class);
        // abort(404);  // If you want to quickly send the error response
        $pageSize = $request->page_size ?? 20; // users can set items per query
        // $posts = Post::query()->where('id', '=', '1')->get();
        $posts = Post::query()->paginate($pageSize);

        return PostResource::collection($posts);
    }

     /**
     * Store a newly created post in storage.
     * @bodyParam title string required Title of the post. Example: Amazing Post
     * @bodyParam body string[] required Body of the post. Example: ["This post is super beautiful"]
     * @bodyParam user_ids int[] required The author ids of the post. Example: [1, 2]
     * @apiResource App\Http\Resources\PostResource
     * @apiResourceModel App\Models\Post
     * @param  PostStoreRequest  $request
     * @return PostResource
     */
    public function store(Request $request, PostRepository $repository)
    {
        $payload = $request->only([
            'title',
            'body',
            'user_ids'
        ]);

        $validator = Validator::make($payload, [
            'title' => 'string|required',  // method 1
            'body' => ['string', 'required'], // method 2
            'user_ids' => [
                'array',
                'required',
                new IntegerArray(), // custom Rule Class to perform validation
            ]
        ], [
            'body.required' => 'Please enter a value for post body',
            'title.string' => 'HEYYYY Enter a string!!'
        ]);

        // runs after the validation is done
        // $validator->after(function (\Illuminate\Validation\Validator $validator) {
        //     dump("heyaya");
        // });

        // $errors = $validator->errors();  // returns all the validation errors
        // $errors = $validator->messages();  // returns all the validation errors
        // dd($errors);
        // dd($validator->fails()); // returns true if validation failed
        // dd($validator->passes()); // inverses the "fails()" result

        // dump($validator->getData());  // gets attributes that we passed to the validator
        // dd($validator->attributes());  // gets attributes that we passed to the validator
        dd($validator->validateString("test", 123)); // Validate that an attribute is a string.

        $validator->validate();  // run the validator

        $created = $repository->create($payload);

        return new PostResource($created);
    }

    /**
     * Display the specified post.
     * @apiResource App\Http\Resources\PostResource
     * @apiResourceModel App\Models\Post
     * @param  \App\Models\Post  $post
     * @return PostResource
     * 
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified post in storage.
     * @bodyParam title string required Title of the post. Example: Amazing Post
     * @bodyParam body string[] required Body of the post. Example: ["This post is super beautiful"]
     * @bodyParam user_ids int[] required The author ids of the post. Example: [1, 2]
     * @apiResource App\Http\Resources\PostResource
     * @apiResourceModel App\Models\Post
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return PostResource | JsonResponse
     */
    public function update(Request $request, Post $post, PostRepository $repository)
    {
        // $updated = $post->update($request->only(['title', 'body']));
        $updated = $repository->update($post, $request->only([
            'title',
            'body',
            'user_ids'
        ]));

        return new PostResource($updated);
    }

     /**
     * Remove the specified post from storage.
     * @response 200 {
     *  "data": "success"
     * }
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post, PostRepository $repository)
    {
        $deleted = $repository->forceDelete($post);

        return new JsonResponse([
            'data' => "Post deleted successfully!"
        ]);
    }
}
