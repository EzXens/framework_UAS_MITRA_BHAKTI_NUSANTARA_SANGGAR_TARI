<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassEnrollment;
use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // getter enrolled classes
        $enrolledClasses = ClassEnrollment::where('user_id', $user->id)
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
        
        return view('user.dashboard', compact('user', 'enrolledClasses', 'schedules'));
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
