<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function index($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('backend.pages.index', compact('page'));
    }
}
