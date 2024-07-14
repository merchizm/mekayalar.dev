<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Poem;
use Inertia\Response;
use Inertia\ResponseFactory;

class PoemController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        return inertia('Poem/Index', [
            'poems' => Poem::orderBy('wrote_at', 'desc')->get()
        ]);
    }

    public function show(string $slug)
    {
        $poem = Poem::where('slug', $slug)->firstOrFail();

        return inertia('Poem/Poem', [
            'poem' => $poem
        ]);
    }
}
