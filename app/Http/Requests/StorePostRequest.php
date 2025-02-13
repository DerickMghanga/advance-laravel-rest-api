<?php

namespace App\Http\Requests;

use App\Rules\IntegerArray;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'string|required',  // method 1
            'body' => ['string', 'required'], // method 2
            'user_ids' => [
                'array',
                'required',
                new IntegerArray(), // custom Rule Class to perform validation
                // function ($attribute, $value, $fail) { //"$fail" is used to create custom error message
                //     $integerOnly = collect($value)->every(fn($element) => is_int($element));

                //     if (!$integerOnly) {
                //         $fail($attribute . " can only be integers");
                //     }
                // }
            ],
        ];
    }


    /**
     * Custom Error message incase validation fails
     * 
     */
    public function messages()
    {
        return [
            'body.required' => 'Please enter a value for post body',
            'title.string' => 'HEYYYY Enter a string!!'
        ];
    }
}
