<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageViewerController extends Controller
{
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->where('status', 'published')->with('blocks')->firstOrFail();
        return view('pages.show', compact('page'));
    }
}
