<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageTextSection;
use Illuminate\Http\Request;

class HomepageTextSectionController extends Controller
{
    /**
     * Update existing text section (Edit only, no create/delete)
     */
    public function update(Request $request, $id)
    {
        $text = HomepageTextSection::findOrFail($id);
        
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $text->update($validated);

        return redirect()->route('admin.dashboard', ['#' => 'homepage-texts'])
            ->with('success', 'Teks homepage berhasil diperbarui!')
            ->with('show_section', 'homepage-texts');
    }
}
