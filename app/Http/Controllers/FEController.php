<?php

namespace App\Http\Controllers;

use App\Models\Poem;
use App\Services\RaindropService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FEController extends Controller
{
    private RaindropService $bookmarkService;

    public function __construct()
    {
        $this->bookmarkService = new RaindropService();
    }

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
        /**
         * burada şimdilik geçici basit bir cache yapısı oluşturdum.
         * asıl hedef ise yeni içeriğin girilmesine bağlı yenilenen cache mekaniği
         */
        if(Cache::has('raindrop_bookmarks'))
            $bookmarks = Cache::get('raindrop_bookmarks');
        else{
            $bookmarks = $this->bookmarkService->getBookmarksGroupByDay();
            Cache::put('raindrop_bookmarks', $bookmarks, '1 day');
        }


        return inertia('Bookmarks/Index', [
            'bookmarks' => $bookmarks
        ]);
    }
}
