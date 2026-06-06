<?php

namespace App\Http\Controllers;

use App\Models\Story;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::all();

        return view('pages.stories.index', compact('stories'));
    }

    public function show(Story $story)
    {
        return view('pages.stories.show', compact('story'));
    }
}
