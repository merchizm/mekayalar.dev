<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\RaindropService;
use Illuminate\Support\Facades\Cache;
use Inertia\Response;
use Inertia\ResponseFactory;

class BookmarkController extends Controller
{
    private RaindropService $bookmarkService;

    public function __construct()
    {
        $this->bookmarkService = new RaindropService();
    }

    public function index(): Response|ResponseFactory
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
