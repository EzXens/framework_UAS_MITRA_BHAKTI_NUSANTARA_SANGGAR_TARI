<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassEnrollment;
use App\Notifications\EnrollmentStatusChanged;

class EnrollmentController extends Controller
{
    /**
     * Approve an enrollment.
     */
    public function approve(Request $request, $id)
    {
        $enrollment = ClassEnrollment::findOrFail($id);
        $enrollment->status = 'approved';
        // optional: store any admin note
        if ($request->filled('notes')) {
            $enrollment->notes = $request->input('notes');
        }
        $enrollment->save();

        // notify the user about approval
        try {
            if ($enrollment->user) {
                $enrollment->user->notify(new EnrollmentStatusChanged($enrollment));
            }
        } catch (\Exception $e) {
            // don't block admin flow if notification fails
        }

        return redirect()->back()->with('success', 'Pendaftaran berhasil disetujui.');
    }

    /**
     * Reject an enrollment with a reason.
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:2000',
        ]);

        $enrollment = ClassEnrollment::findOrFail($id);
        $enrollment->status = 'rejected';
        $enrollment->notes = $request->input('reason');
        $enrollment->save();

        // notify the user about rejection (with reason)
        try {
            if ($enrollment->user) {
                $enrollment->user->notify(new EnrollmentStatusChanged($enrollment));
            }
        } catch (\Exception $e) {
            // ignore notification failures
        }

        return redirect()->back()->with('success', 'Pendaftaran telah ditolak.');
    }
}
