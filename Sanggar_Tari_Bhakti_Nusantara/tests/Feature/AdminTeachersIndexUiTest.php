<?php

use App\Models\User;
use App\Models\Teacher;

it('renders status toggle and move buttons on admin teachers index', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    Teacher::create(['name' => 'Pengajar C', 'position' => 'Instruktur', 'is_active' => true]);
    $this->actingAs($admin);

    $response = $this->get(route('admin.teachers.index'));
    $response->assertStatus(200);
    $response->assertSee('status-toggle', false);
    $response->assertSee('btn-move-up', false);
    $response->assertSee('btn-move-down', false);
    $response->assertSee('aria-live="polite"', false);
});
