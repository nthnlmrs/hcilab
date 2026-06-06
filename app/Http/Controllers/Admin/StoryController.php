<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::all();

        return view('admin.stories.index', compact('stories'));
    }

    public function create()
    {
        return view('admin.stories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:4096',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('stories', 'public');
        }

        Story::create([
            'title' => $request->title,
            'category' => $request->category,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'image' => $imagePath ? asset('storage/'.$imagePath) : null,
        ]);

        return redirect()->route('admin.stories.index')->with('success', 'Story created successfully.');
    }

    public function edit(Story $story)
    {
        return view('admin.stories.edit', compact('story'));
    }

    public function update(Request $request, Story $story)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:4096',
        ]);

        $imagePath = $story->image;
        if ($request->hasFile('image')) {
            if ($story->image && str_contains($story->image, 'storage/stories')) {
                $oldPath = str_replace(asset('storage/'), '', $story->image);
                Storage::disk('public')->delete($oldPath);
            }
            $uploadedPath = $request->file('image')->store('stories', 'public');
            $imagePath = asset('storage/'.$uploadedPath);
        }

        $story->update([
            'title' => $request->title,
            'category' => $request->category,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.stories.index')->with('success', 'Story updated successfully.');
    }

    public function destroy(Story $story)
    {
        if ($story->image && str_contains($story->image, 'storage/stories')) {
            $oldPath = str_replace(asset('storage/'), '', $story->image);
            Storage::disk('public')->delete($oldPath);
        }

        $story->delete();

        return redirect()->route('admin.stories.index')->with('success', 'Story deleted successfully.');
    }
}
