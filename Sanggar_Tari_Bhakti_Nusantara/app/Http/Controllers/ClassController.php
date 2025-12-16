<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\ClassEnrollment;
use App\Models\Teacher;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function publicIndex()
    {
        $classes = ClassModel::latest()->paginate(12);
        
        $enrolledClassIds = [];
        if (Auth::check()) {
            // Only consider approved enrollments as "already registered" for the user
            // Cast to integers and ensure uniqueness to avoid accidental truthy matches in the view
            $enrolledClassIds = ClassEnrollment::where('user_id', Auth::id())
                ->where('status', 'approved')
                ->pluck('class_id')
                ->map(function ($id) { return (int) $id; })
                ->unique()
                ->values()
                ->toArray();
        }
        
        return view('pages.classes', compact('classes', 'enrolledClassIds'));
    }

    public function enroll(Request $request, ClassModel $class)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mendaftar kelas.');
        }

        // cek kapasitas kelas
        $currentEnrollments = ClassEnrollment::where('class_id', $class->id)
            ->whereIn('status', ['pending', 'approved'])
            ->count();

        if ($currentEnrollments >= $class->capacity) {
            return back()->with('error', 'Kapasitas kelas sudah penuh.');
        }

        // Check for existing active enrollment (pending or approved) that should block re-registration
        $existingActive = ClassEnrollment::where('user_id', Auth::id())
            ->where('class_id', $class->id)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingActive) {
            return back()->with('error', 'Anda sudah terdaftar di kelas ini.');
        }

        // If there is a previously rejected enrollment, allow re-registration by reusing that record
        $previousRejected = ClassEnrollment::where('user_id', Auth::id())
            ->where('class_id', $class->id)
            ->where('status', 'rejected')
            ->first();

        if ($previousRejected) {
            $previousRejected->status = 'pending';
            $previousRejected->notes = $request->input('notes');
            $previousRejected->save();
        } else {
            ClassEnrollment::create([
                'user_id' => Auth::id(),
                'class_id' => $class->id,
                'status' => 'pending',
                'notes' => $request->input('notes')
            ]);
        }

        return back()->with('success', 'Pendaftaran kelas berhasil! Silakan tunggu konfirmasi admin.');
    }

    public function index(Request $request)
    {
        $classes = ClassModel::latest()->paginate(25);
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'html' => view('admin.classes.table', compact('classes'))->render(),
                'pagination' => view('components.pagination', ['paginator' => $classes])->render()
            ]);
        }
        
        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        $teachers = \App\Models\Teacher::where('is_active', true)->ordered()->get();
        $selectedTeacherIds = [];
        return view('admin.classes.create', compact('teachers', 'selectedTeacherIds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'instructor' => 'required|string|max:255',
            'days' => 'required|array|min:1',
            'days.*' => 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'capacity' => 'required|integer|min:1',
            // price removed from validation
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'teacher_ids' => 'nullable|array',
            'teacher_ids.*' => 'integer|min:1',
        ]);

        $data = $request->except(['days', 'start_time', 'end_time']);
        
        // format schedule: "Senin & Rabu, 16:00-18:00"
        $daysString = implode(' & ', $request->days);
        $timeString = $request->start_time . '-' . $request->end_time;
        $data['schedule'] = $daysString . ', ' . $timeString;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('classes', 'public');
        }

        $class = ClassModel::create($data);

        $ids = collect($request->input('teacher_ids', []))
            ->filter(fn($id) => is_numeric($id))
            ->map(fn($id) => (int) $id)
            ->unique()
            ->values()
            ->toArray();
        if (!empty($ids)) {
            $activeIds = \App\Models\Teacher::whereIn('id', $ids)->where('is_active', true)->pluck('id')->toArray();
            if (count($activeIds) !== count($ids)) {
                return back()->withErrors(['teacher_ids' => 'Terdapat pengajar yang tidak tersedia/aktif'])->withInput();
            }
            $class->teachers()->sync($activeIds);
        }

        return redirect()->route('classes.index')->with('success', 'Kelas berhasil ditambahkan!');
    }

    public function show(ClassModel $class)
    {
        return view('classes.show', compact('class'));
    }

    public function edit(ClassModel $class)
    {
        $teachers = Teacher::where('is_active', true)->ordered()->get();
        $selectedTeacherIds = $class->teachers()->pluck('teachers.id')->toArray();
        return view('admin.classes.edit', compact('class', 'teachers', 'selectedTeacherIds'));
    }

    public function update(Request $request, ClassModel $class)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'instructor' => 'required|string|max:255',
            'days' => 'required|array|min:1',
            'days.*' => 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'capacity' => 'required|integer|min:1',
            // price removed from validation
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'teacher_ids' => 'nullable|array',
            'teacher_ids.*' => 'integer|min:1',
        ]);

        $data = $request->except(['days', 'start_time', 'end_time']);
        
        // Format schedule: "Senin & Rabu, 16:00-18:00"
        $daysString = implode(' & ', $request->days);
        $timeString = $request->start_time . '-' . $request->end_time;
        $data['schedule'] = $daysString . ', ' . $timeString;

        if ($request->hasFile('image')) {
            if ($class->image) {
                Storage::disk('public')->delete($class->image);
            }
            $data['image'] = $request->file('image')->store('classes', 'public');
        }

        $class->update($data);
        
        // Validate and sync teachers team
        $ids = collect($request->input('teacher_ids', []))
            ->filter(fn($id) => is_numeric($id))
            ->map(fn($id) => (int) $id)
            ->unique()
            ->values()
            ->toArray();
        if (!empty($ids)) {
            $activeIds = Teacher::whereIn('id', $ids)->where('is_active', true)->pluck('id')->toArray();
            if (count($activeIds) !== count($ids)) {
                return back()->withErrors(['teacher_ids' => 'Terdapat pengajar yang tidak tersedia/aktif'])->withInput();
            }
            $class->teachers()->sync($activeIds);
        } else {
            $class->teachers()->sync([]);
        }

        return redirect()->route('classes.index')->with('success', 'Kelas berhasil diupdate!');
    }

    public function destroy(ClassModel $class)
    {
        if ($class->image) {
            Storage::disk('public')->delete($class->image);
        }
        
        $class->delete();

        return redirect()->route('classes.index')->with('success', 'Kelas berhasil dihapus!');
    }
}
