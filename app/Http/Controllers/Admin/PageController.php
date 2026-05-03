<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'blocks' => 'required|array',
        ]);

        $slug = Str::slug($request->title) . '-' . uniqid();
        $url = url('/p/' . $slug);
        
        $qrPath = 'qrcodes/' . $slug . '.svg';
        if (!file_exists(public_path('qrcodes'))) {
            mkdir(public_path('qrcodes'), 0777, true);
        }
        QrCode::size(300)->generate($url, public_path($qrPath));

        $page = Page::create([
            'title' => $request->title,
            'slug' => $slug,
            'qr_code_path' => $qrPath,
        ]);

        foreach ($request->blocks as $index => $block) {
            PageBlock::create([
                'page_id' => $page->id,
                'type' => $block['type'],
                'content' => $block['content'],
                'order' => $index,
            ]);
        }

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }
}
