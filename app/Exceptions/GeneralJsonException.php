<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class GeneralJsonException extends Exception
{
    protected $code = 422; // Custom http response code, you can overide from Exception class
    /**
     * Report the exception (Runs before the render() method)
     * 
     * @return void
     */
    public function report() {
        dump("aaabbcccdd");
    }

    /**
     * Render the exception as an HTTP response
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function render($request)
    {
        return new JsonResponse([
            'errors' => [
                'message' => $this->getMessage(),
            ]
        ], $this->code);
    }
}
