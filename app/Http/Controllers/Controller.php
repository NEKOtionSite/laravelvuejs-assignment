<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * The base controller for all application controllers.
 *
 * This class extends the Laravel `BaseController` and includes traits
 * for authorizing requests and validating requests.
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
