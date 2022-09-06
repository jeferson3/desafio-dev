<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 *
 * @OA\Server(url="http://localhost:8000/api")
 * @OA\Info(
 *      version="1.0.0",
 *      title="Api Test PHP",
 *      description="Api para listar transações de loja e cliente",
 *      version="1.0.0",
 *      @OA\Contact(
 *          email="jefersongomes333@hotmail.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
