<?php

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;

it('allows admin to update teacher status and logs the change', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $teacher = Teacher::create([
        'name' => 'Pengajar A',
        'position' => 'Instruktur',
        'is_active' => true,
    ]);
    $this->actingAs($admin);

    $response = $this->put(route('admin.teachers.status', ['teacher' => $teacher->id]), [
        'status' => 0,
    ]);
    $response->assertStatus(200)->assertJson(['success' => true]);

    $teacher->refresh();
    expect($teacher->is_active)->toBeFalse();

    $log = DB::table('teacher_status_logs')->where('teacher_id', $teacher->id)->latest()->first();
    expect($log)->not->toBeNull();
    expect($log->new_status)->toBe(0);
    expect($log->admin_id)->toBe($admin->id);
});

it('blocks non-admin from updating teacher status', function () {
    $user = User::factory()->create(['role' => 'user']);
    $teacher = Teacher::create([
        'name' => 'Pengajar B',
        'position' => 'Instruktur',
        'is_active' => true,
    ]);
    $this->actingAs($user);

    $response = $this->put(route('admin.teachers.status', ['teacher' => $teacher->id]), [
        'status' => 0,
    ]);
    // Depending on middleware, could be 403 or redirect; assert not 200
    expect($response->status())->not()->toBe(200);
});
