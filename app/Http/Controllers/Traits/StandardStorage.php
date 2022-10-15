<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;

trait StandardStorage
{
    /**
     * Image storage handler to standardize and facilitate storage.
     * 
     * @param  Illuminate\Http\Request  $request
     * @param  array  @vars
     * @return string|bool
     */
    function storeImage(Request $request, array $vars = ['input' => 'image', 'path' => 'images', 'disk' => 'public'])
    {
        extract($vars);

        return $request
            ->file($input)
            ->store($path, $disk);
    }
}