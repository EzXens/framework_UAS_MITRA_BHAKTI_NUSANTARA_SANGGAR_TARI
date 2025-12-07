<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassEnrollment;
use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Dispensation;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // getter enrolled classes (only approved should be considered "enrolled")
        $enrolledClasses = ClassEnrollment::where('user_id', $user->id)
            ->where('status', 'approved')
            ->with('class')
            ->latest()
            ->get();

        // also expose pending enrollments so dashboard can show waiting state if needed
        $pendingEnrollments = ClassEnrollment::where('user_id', $user->id)
            ->where('status', 'pending')
            ->with('class')
            ->latest()
            ->get();
        
        // parse schedule
        $schedules = [];
        foreach ($enrolledClasses as $enrollment) {
            if ($enrollment->class) {
                $schedule = $enrollment->class->schedule;
                $schedules[] = [
                    'class_name' => $enrollment->class->name,
                    'schedule' => $schedule,
                    'instructor' => $enrollment->class->instructor,
                ];
            }
        }
        
        // user's dispensations
        $dispensations = Dispensation::where('user_id', $user->id)->latest()->get();

        // if admin, also fetch pending dispensations for quick approval in aktivitas
        $pendingDispensations = [];
        if ($user->role === 'admin') {
            $pendingDispensations = Dispensation::where('status', 'pending')->latest()->take(10)->get();
        }

        return view('user.dashboard', compact('user', 'enrolledClasses', 'pendingEnrollments', 'schedules', 'dispensations', 'pendingDispensations'));
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // delete old pp if exists
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // store new pp
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        
        $user->update([
            'profile_picture' => $path
        ]);

        return back()->with('success', 'Foto profil berhasil diperbarui!');
    }
}
