<?php

namespace App\Http\Controllers;

use App\Models\Poem;
use Illuminate\Http\Request;

class FEController extends Controller
{
    public function index()
    {
        return inertia('Index/Index');
    }

    public function blog()
    {
        return inertia('Blog/Blog');
    }

    public function poems()
    {
        return inertia('Poem/Index', [
            'poems' => Poem::orderBy('wrote_at', 'desc')->get()
        ]);
    }

    public function bookmarks()
    {
        return inertia('Bookmarks/Index', []);
    }
}
