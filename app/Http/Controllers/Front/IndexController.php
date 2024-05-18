<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Inertia\Response;
use Inertia\ResponseFactory;

class IndexController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        return inertia('Index/Index');
    }
}
