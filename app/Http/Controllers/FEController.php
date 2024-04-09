<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FEController extends Controller
{
    public function index()
    {
        return inertia('Index/Index');
    }
}
