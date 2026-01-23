<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of all users.
     */
    public function index()
    {
        $users = User::where('role', '!=', 'admin')
                    ->whereNull('scheduled_deletion_at')
                    ->paginate(10);
        $deletionPendingUsers = User::where('role', '!=', 'admin')
                                    ->whereNotNull('scheduled_deletion_at')
                                    ->get();
        return view('admin.users.index', compact('users', 'deletionPendingUsers'));
    }

    /**
     * Schedule a user for deletion.
     */
    public function scheduleDelete(Request $request, User $user)
    {
        $deletionDays = 30; // Fixed 30 days
        $scheduledDeletionAt = now()->addDays($deletionDays);

        $user->update([
            'scheduled_deletion_at' => $scheduledDeletionAt,
            'deletion_days' => $deletionDays,
        ]);

        return redirect()->route('admin.users.index')
                         ->with('success', "User '{$user->name}' dijadwalkan untuk dihapus dalam {$deletionDays} hari");
    }

    /**
     * Cancel scheduled deletion.
     */
    public function cancelDelete(User $user)
    {
        if (!$user->isScheduledForDeletion()) {
            return redirect()->route('admin.users.index')
                             ->with('error', 'User ini tidak terjadwal untuk dihapus');
        }

        $user->update([
            'scheduled_deletion_at' => null,
            'deletion_days' => null,
        ]);

        return redirect()->route('admin.users.index')
                         ->with('success', "Penghapusan user '{$user->name}' telah dibatalkan");
    }

    /**
     * Delete a user immediately (used by scheduler).
     */
    public function destroy(User $user)
    {
        $userName = $user->name;
        $user->forceDelete();
        
        return redirect()->route('admin.users.index')
                         ->with('success', "User '{$userName}' berhasil dihapus permanen");
    }
}

