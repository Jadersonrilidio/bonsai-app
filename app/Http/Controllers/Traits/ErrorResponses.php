<?php

namespace App\Http\Controllers\Traits;

trait ErrorResponses
{
    /**
     * Return a standard Response object with httpCode and error message embeed.
     * 
     * @param  string  $errorMsg
     * @param  integer  $httpCode
     * @param  array  $headerOptions
     * @return Illuminate\Http\JsonResponse
     */
    function notFound($errorMsg = 'resource not found', $httpCode = 404, $headerOptions = [])
    {
        return response()
            ->json(['error' => $errorMsg], $httpCode, $headerOptions);
    }

    /**
     * Return a standard Response object with httpCode and error message embeed.
     * 
     * @param  string  $errorMsg
     * @param  integer  $httpCode
     * @param  array  $headerOptions
     * @return Illuminate\Http\JsonResponse
     */
    function unauthorized($errorMsg = 'unauthorized', $httpCode = 401, $headerOptions = [])
    {
        return response()
            ->json(['error' => $errorMsg], $httpCode, $headerOptions);
    }

    /**
     * Return a standard Response object with httpCode and error message embeed.
     * 
     * @param  string  $errorMsg
     * @param  integer  $httpCode
     * @param  array  $headerOptions
     * @return Illuminate\Http\JsonResponse
     */
    function forbidden($errorMsg = 'forbidden', $httpCode = 403, $headerOptions = [])
    {
        return response()
            ->json(['error' => $errorMsg], $httpCode, $headerOptions);
    }
}
