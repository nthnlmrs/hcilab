<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Update the dashboard cover settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'dashboard_museum_image' => 'nullable|image|max:4096',
            'dashboard_collections_image' => 'nullable|image|max:4096',
            'dashboard_stories_image' => 'nullable|image|max:4096',
        ]);

        $keys = [
            'dashboard_museum_image',
            'dashboard_collections_image',
            'dashboard_stories_image',
        ];

        foreach ($keys as $key) {
            // Check if user wants to delete/reset the image
            if ($request->has('delete_'.$key)) {
                $oldPath = Setting::get($key);
                if ($oldPath) {
                    Storage::disk('public')->delete($oldPath);
                }
                Setting::set($key, null);

                continue;
            }

            // Check if a new file is uploaded
            if ($request->hasFile($key)) {
                $oldPath = Setting::get($key);
                if ($oldPath) {
                    Storage::disk('public')->delete($oldPath);
                }

                $path = $request->file($key)->store('settings', 'public');
                Setting::set($key, $path);
            }
        }

        return redirect()->route('admin.dashboard')->with('success', 'Dashboard cover settings updated successfully.');
    }
}
