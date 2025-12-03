<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageTextSection;
use Illuminate\Http\Request;

class HomepageTextSectionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|unique:homepage_text_sections|string',
            'label' => 'required|string',
            'content' => 'required|string',
        ]);

        HomepageTextSection::create($validated);

        return redirect()->route('admin.dashboard')->with('show_section', 'homepage-texts');
    }

    public function update(Request $request, $id)
    {
        $text = HomepageTextSection::findOrFail($id);
        
        $validated = $request->validate([
            'label' => 'required|string',
            'content' => 'required|string',
        ]);

        $text->update($validated);

        return redirect()->route('admin.dashboard')->with('show_section', 'homepage-texts');
    }

    public function destroy($id)
    {
        HomepageTextSection::findOrFail($id)->delete();
        return redirect()->route('admin.dashboard')->with('show_section', 'homepage-texts');
    }
}
