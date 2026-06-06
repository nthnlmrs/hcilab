<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

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
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published',
            'blocks' => 'nullable|array',
        ]);

        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (Page::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $coverImagePath = null;
        if ($request->hasFile('cover_image')) {
            $coverImagePath = $request->file('cover_image')->store('pages', 'public');
        }

        $url = url('/p/' . $slug);
        $qrPath = 'qrcodes/' . $slug . '.svg';
        if (!Storage::disk('public')->exists('qrcodes')) {
            Storage::disk('public')->makeDirectory('qrcodes');
        }
        QrCode::size(300)->generate($url, storage_path('app/public/' . $qrPath));

        $page = Page::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'cover_image' => $coverImagePath,
            'status' => $request->status,
            'qr_code_path' => $qrPath,
        ]);

        if ($request->blocks) {
            foreach ($request->blocks as $index => $block) {
                $blockData = $block['data'] ?? [];

                // Handle file uploads within blocks if any (e.g., image block)
                if ($block['type'] === 'image' && isset($block['image_file'])) {
                     $blockData['url'] = $block['image_file']->store('blocks', 'public');
                } elseif ($block['type'] === 'card' && isset($block['image_file'])) {
                     $blockData['image'] = $block['image_file']->store('blocks', 'public');
                }

                PageBlock::create([
                    'page_id' => $page->id,
                    'type' => $block['type'],
                    'content' => $block['content'] ?? null,
                    'data' => $blockData,
                    'order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    public function edit(Page $page)
    {
        $page->load('blocks');
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published',
            'blocks' => 'nullable|array',
        ]);

        $data = $request->only(['title', 'description', 'status']);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('pages', 'public');
        }

        // Only update slug if title changed significantly? Let's keep slug same for existing QR code unless requested,
        // For simplicity and to not break existing QRs, we will NOT update the slug on edit.

        $page->update($data);

        $page->blocks()->delete();

        if ($request->blocks) {
            foreach ($request->blocks as $index => $block) {
                $blockData = $block['data'] ?? [];

                if ($block['type'] === 'image') {
                    if (isset($block['image_file'])) {
                        $blockData['url'] = $block['image_file']->store('blocks', 'public');
                    } elseif (isset($block['existing_image'])) {
                        $blockData['url'] = $block['existing_image'];
                    }
                } elseif ($block['type'] === 'card') {
                    if (isset($block['image_file'])) {
                        $blockData['image'] = $block['image_file']->store('blocks', 'public');
                    } elseif (isset($block['existing_image'])) {
                        $blockData['image'] = $block['existing_image'];
                    }
                }

                PageBlock::create([
                    'page_id' => $page->id,
                    'type' => $block['type'],
                    'content' => $block['content'] ?? null,
                    'data' => $blockData,
                    'order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }

    public function toggleStatus(Page $page)
    {
        $page->update([
            'status' => $page->status === 'published' ? 'draft' : 'published'
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Page status updated successfully.');
    }
}
