<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CollectionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CollectionItemController extends Controller
{
    public function index()
    {
        $collections = CollectionItem::all();

        return view('admin.collections.index', compact('collections'));
    }

    public function create()
    {
        return view('admin.collections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('collections', 'public');
        }

        CollectionItem::create([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'image' => $imagePath ? asset('storage/'.$imagePath) : null,
        ]);

        return redirect()->route('admin.collections.index')->with('success', 'Collection item created successfully.');
    }

    public function edit(CollectionItem $collection)
    {
        return view('admin.collections.edit', compact('collection'));
    }

    public function update(Request $request, CollectionItem $collection)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
        ]);

        $imagePath = $collection->image;
        if ($request->hasFile('image')) {
            if ($collection->image && str_contains($collection->image, 'storage/collections')) {
                $oldPath = str_replace(asset('storage/'), '', $collection->image);
                Storage::disk('public')->delete($oldPath);
            }
            $uploadedPath = $request->file('image')->store('collections', 'public');
            $imagePath = asset('storage/'.$uploadedPath);
        }

        $collection->update([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.collections.index')->with('success', 'Collection item updated successfully.');
    }

    public function destroy(CollectionItem $collection)
    {
        if ($collection->image && str_contains($collection->image, 'storage/collections')) {
            $oldPath = str_replace(asset('storage/'), '', $collection->image);
            Storage::disk('public')->delete($oldPath);
        }

        $collection->delete();

        return redirect()->route('admin.collections.index')->with('success', 'Collection item deleted successfully.');
    }
}
