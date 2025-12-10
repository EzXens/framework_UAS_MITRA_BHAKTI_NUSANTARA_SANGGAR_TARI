<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageCarousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomepageCarouselController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('homepage/carousel', 'public');
        }

        HomepageCarousel::create($validated);

        return redirect()->route('admin.dashboard', ['#' => 'homepage-carousel'])
            ->with('success', 'Carousel berhasil ditambahkan!')
            ->with('show_section', 'homepage-carousel');
    }

    public function update(Request $request, $id)
    {
        $carousel = HomepageCarousel::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            if ($carousel->image) {
                Storage::disk('public')->delete($carousel->image);
            }
            $validated['image'] = $request->file('image')->store('homepage/carousel', 'public');
        }

        $carousel->update($validated);

        return redirect()->route('admin.dashboard', ['#' => 'homepage-carousel'])
            ->with('success', 'Carousel berhasil diperbarui!')
            ->with('show_section', 'homepage-carousel');
    }

    public function destroy($id)
    {
        $carousel = HomepageCarousel::findOrFail($id);
        if ($carousel->image) {
            Storage::disk('public')->delete($carousel->image);
        }
        $carousel->delete();
        
        return redirect()->route('admin.dashboard', ['#' => 'homepage-carousel'])
            ->with('success', 'Carousel berhasil dihapus!')
            ->with('show_section', 'homepage-carousel');
    }
}
