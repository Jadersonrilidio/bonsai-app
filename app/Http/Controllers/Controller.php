<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 *     API Docs Annotation:
 * 
 * @OA\Info(
 *     version="1.0.0",
 *     title="Laravel Bonsai App API Documentation",
 *     description="L5 Swagger API DOcumentation",
 *     @OA\Contact(
 *         email="jadersonrilidio@gmail.com"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 * 
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Test API Server"
 * )
 * 
 * @OA\Tag(
 *     name="Bonsai App API",
 *     description="API Endpoints"
 * )
 * 
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
