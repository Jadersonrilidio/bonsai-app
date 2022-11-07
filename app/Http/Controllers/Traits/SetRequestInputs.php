<?php

namespace App\Http\Controllers\Traits;

use \Illuminate\Http\Request;

trait SetRequestInputs
{
    /**
     * Set the filters request input to query if exists.
     * 
     * @param  string  $input
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    function setFilters(string $input, Request $request)
    {
        if (!$this->validateInput($request, $input))
            return [];

        $filters = explode(';', $request->get($input));
        
        $filters = array_map(fn ($filter) => explode(':', $filter), $filters);

        return $filters;
    }

    /**
     * Edit and return the model attributes from the request input if exists.
     * 
     * @param  string  $input
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    function setAttr(string $input, Request $request)
    {
        if (!$this->validateInput($request, $input))
            return [];

        $attr = explode(',', $request->get($input));
        array_push($attr, 'id');

        return $attr;
    }

    /**
     * Edit and return a relationship attributes from the request input if exists.
     * 
     * @param  string  $relationship
     * @param  string  $foreign
     * @param  string  $input
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    function setRelAttr(string $relationship, string $foreign, string $input, Request $request)
    {
        if (!$this->validateInput($request, $input))
            return $relationship;

        $query = $relationship . ':';

        if ($foreign)
            $query .= $foreign . ',';

        $query .= $request->get($input);

        return $query;
    }

    /**
     * Assert request input value is valid.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $input
     * @return bool
     */
    private function validateInput($request, $input)
    {
        return ($request->has($input) and $request->get($input) != '')
            ? true
            : false;
    }
}
