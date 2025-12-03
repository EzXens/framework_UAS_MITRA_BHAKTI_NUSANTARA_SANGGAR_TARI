<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomepageSectionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('homepage/sections', 'public');
        }

        HomepageSection::create($validated);

        return redirect()->route('admin.dashboard')->with('show_section', 'homepage-sections');
    }

    public function update(Request $request, $id)
    {
        $section = HomepageSection::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($section->image) {
                Storage::disk('public')->delete($section->image);
            }
            $validated['image'] = $request->file('image')->store('homepage/sections', 'public');
        }

        $section->update($validated);

        return redirect()->route('admin.dashboard')->with('show_section', 'homepage-sections');
    }

    public function destroy($id)
    {
        $section = HomepageSection::findOrFail($id);
        if ($section->image) {
            Storage::disk('public')->delete($section->image);
        }
        $section->delete();
        return redirect()->route('admin.dashboard')->with('show_section', 'homepage-sections');
    }
}
