<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

trait SetRequestInputs
{
    /**
     * Set the filters request input to query if exists.
     * 
     * @param  string  $filters
     * @return array
     */
    private function setFilters($filters)
    {
        if (!$filters)
            return '';

        $filters = explode(';', $filters);
        array_map(fn ($filter) => explode(':', $filter), $filters); //REVIEW

        return $filters;
    }

    /**
     * Edit and return the model attributes from the request input if exists.
     * 
     * @param  string  $attr
     * @return array
     */
    private function setAttr($attr)
    {
        if (!$attr)
            return '';

        $attr = explode(',', $attr);
        array_push($attr, 'id');

        return $attr;
    }

    /**
     * Edit and return a relationship attributes from the request input if exists.
     * 
     * @param  string  $relationship
     * @param  string  $relationship
     * @param  string  $rel_attr
     * @return string
     */
    private function setRelAttr($relationship, $foreign, $rel_attr)
    {
        return ($rel_attr)
            ? $relationship . ':' . $foreign . ',' . $rel_attr
            : '';
    }
}
