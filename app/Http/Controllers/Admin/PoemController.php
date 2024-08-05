<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poem;

class PoemController extends Controller
{
    public function index()
    {
        return inertia('Admin/Poem/Index', [
            'poems' => Poem::orderBy('wrote_at', 'desc')->get()
        ]);
    }

    public function store()
    {
        // store the poem
    }

    public function update($id)
    {
        // update the poem
    }

    public function destroy($id)
    {
        // delete the poem
    }
}
