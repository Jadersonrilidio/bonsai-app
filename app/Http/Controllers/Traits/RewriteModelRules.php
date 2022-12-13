<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

trait RewriteModelRules
{
    /**
     * Rewrite the model rules.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return array
     */
    private function rewriteRules(Request $request, Model $model)
    {
        if ($request->method() === 'PATCH') {
            $rewriteRules = [];

            foreach ($model->rules() as $input => $rule)
                if (array_key_exists($input, $request->all()))
                    $rewriteRules[$input] = $rule;

            return $rewriteRules;
        }

        return $model->rules();
    }
}
