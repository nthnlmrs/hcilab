<?php

namespace App\Http\Controllers;

use App\Models\CollectionItem;

class CollectionItemController extends Controller
{
    public function index()
    {
        $collections = CollectionItem::all();

        return view('pages.collections.index', compact('collections'));
    }
}
