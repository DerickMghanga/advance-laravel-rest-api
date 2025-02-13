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

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Store a newly created resource in storage.
     * 
     * @param StorePostRequest request
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
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, PostRepository $repository)
    {
        $deleted = $repository->forceDelete($post);

        return new JsonResponse([
            'data' => "Post deleted successfully!"
        ]);
    }
}
