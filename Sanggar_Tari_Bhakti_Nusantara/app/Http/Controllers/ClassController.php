<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\ClassEnrollment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function publicIndex()
    {
        $classes = ClassModel::latest()->paginate(12);
        
        $enrolledClassIds = [];
        if (Auth::check()) {
            $enrolledClassIds = ClassEnrollment::where('user_id', Auth::id())
                ->pluck('class_id')
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

        $existingEnrollment = ClassEnrollment::where('user_id', Auth::id())
            ->where('class_id', $class->id)
            ->first();

        if ($existingEnrollment) {
            return back()->with('error', 'Anda sudah terdaftar di kelas ini.');
        }

        ClassEnrollment::create([
            'user_id' => Auth::id(),
            'class_id' => $class->id,
            'status' => 'pending',
            'notes' => $request->input('notes')
        ]);

        return back()->with('success', 'Pendaftaran kelas berhasil! Silakan tunggu konfirmasi admin.');
    }

    public function index()
    {
        $classes = ClassModel::latest()->paginate(10);
        return view('classes.index', compact('classes'));
    }

    public function create()
    {
        return view('classes.create');
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
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except(['days', 'start_time', 'end_time']);
        
        // format schedule: "Senin & Rabu, 16:00-18:00"
        $daysString = implode(' & ', $request->days);
        $timeString = $request->start_time . '-' . $request->end_time;
        $data['schedule'] = $daysString . ', ' . $timeString;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('classes', 'public');
        }

        ClassModel::create($data);

        return redirect()->route('classes.index')->with('success', 'Kelas berhasil ditambahkan!');
    }

    public function show(ClassModel $class)
    {
        return view('classes.show', compact('class'));
    }

    public function edit(ClassModel $class)
    {
        return view('classes.edit', compact('class'));
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
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
