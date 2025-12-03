<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageIcon;
use Illuminate\Http\Request;

class HomepageIconController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'icon_class' => 'required|string',
            'description' => 'nullable|string',
            'link' => 'nullable|string',
        ]);

        HomepageIcon::create($validated);

        return redirect()->route('admin.dashboard')->with('show_section', 'homepage-icons');
    }

    public function update(Request $request, $id)
    {
        $icon = HomepageIcon::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string',
            'icon_class' => 'required|string',
            'description' => 'nullable|string',
            'link' => 'nullable|string',
        ]);

        $icon->update($validated);

        return redirect()->route('admin.dashboard')->with('show_section', 'homepage-icons');
    }

    public function destroy($id)
    {
        HomepageIcon::findOrFail($id)->delete();
        return redirect()->route('admin.dashboard')->with('show_section', 'homepage-icons');
    }
}
