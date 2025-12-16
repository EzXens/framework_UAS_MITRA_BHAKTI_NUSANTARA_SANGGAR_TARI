<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reorderMode = request()->boolean('reorder', false);
        $teachers = $reorderMode ? Teacher::ordered()->get() : Teacher::ordered()->paginate(9);
        if (request()->ajax()) {
            $html = view('admin.settings.teachers._grid', compact('teachers'))->render();
            $pagination = $reorderMode ? '' : view('components.pagination', ['paginator' => $teachers])->render();
            return response()->json(['html' => $html, 'pagination' => $pagination]);
        }
        return view('admin.settings.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usedOrders = Teacher::whereNotNull('order')->orderBy('order')->pluck('name', 'order');
        return view('admin.settings.teachers.create', compact('usedOrders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'specialization' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
        ]);

        if ($request->filled('order')) {
            $occupied = Teacher::where('order', $request->order)->first();
            if ($occupied) {
                return back()->withErrors([
                    'order' => 'Urutan ' . $request->order . ' sudah dipakai oleh ' . $occupied->name
                ])->withInput();
            }
        }

        $data = $request->except('photo');
        
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('teachers', 'public');
        }

        Teacher::create($data);

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Pengajar berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        $usedOrders = Teacher::whereNotNull('order')
            ->where('id', '!=', $teacher->id)
            ->orderBy('order')
            ->pluck('name', 'order');
        return view('admin.settings.teachers.edit', compact('teacher', 'usedOrders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'specialization' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
        ]);

        if ($request->filled('order')) {
            $occupied = Teacher::where('order', $request->order)->where('id', '!=', $teacher->id)->first();
            if ($occupied) {
                return back()->withErrors([
                    'order' => 'Urutan ' . $request->order . ' sudah dipakai oleh ' . $occupied->name
                ])->withInput();
            }
        }

        $data = $request->except('photo');
        
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($teacher->photo && Storage::disk('public')->exists($teacher->photo)) {
                Storage::disk('public')->delete($teacher->photo);
            }
            $data['photo'] = $request->file('photo')->store('teachers', 'public');
        }

        $teacher->update($data);

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Pengajar berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        // Delete photo if exists
        if ($teacher->photo && Storage::disk('public')->exists($teacher->photo)) {
            Storage::disk('public')->delete($teacher->photo);
        }

        $teacher->delete();

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Pengajar berhasil dihapus');
    }

    /**
     * Reorder teachers based on provided mapping of id -> order
     */
    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'orders' => 'required|array|min:1',
            'orders.*.id' => 'required|integer|exists:teachers,id',
            'orders.*.order' => 'required|integer|min:0',
        ]);

        $orders = $validated['orders'];

        // Ensure no duplicate order values in payload
        $orderValues = array_map(fn($o) => $o['order'], $orders);
        if (count($orderValues) !== count(array_unique($orderValues))) {
            return response()->json([
                'success' => false,
                'message' => 'Nilai urutan tidak boleh duplikat'
            ], 422);
        }

        DB::transaction(function () use ($orders) {
            foreach ($orders as $item) {
                Teacher::where('id', $item['id'])->update(['order' => (int) $item['order']]);
            }
        });

        return response()->json(['success' => true]);
    }

    /**
     * Update teacher active status and log the change
     */
    public function updateStatus(Request $request, Teacher $teacher)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $newStatus = (int) $request->input('status');

        DB::transaction(function () use ($teacher, $newStatus) {
            $teacher->update(['is_active' => $newStatus === 1]);
            DB::table('teacher_status_logs')->insert([
                'teacher_id' => $teacher->id,
                'admin_id' => Auth::id(),
                'new_status' => $newStatus,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
        Cache::forget('active_teachers');

        return response()->json(['success' => true]);
    }
}
