<?php

use App\Models\User;
use App\Models\Teacher;
use App\Models\ClassModel;

it('only shows active teachers in class edit/create', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $class = ClassModel::create([
        'name' => 'Kelas A',
        'description' => 'Desc',
        'instructor' => 'Instruktur',
        'schedule' => 'Senin, 10:00-11:00',
        'capacity' => 10,
    ]);
    $active = Teacher::create(['name' => 'Aktif', 'position' => 'Instruktur', 'is_active' => true]);
    $inactive = Teacher::create(['name' => 'Nonaktif', 'position' => 'Instruktur', 'is_active' => false]);

    $this->actingAs($admin);
    $respCreate = $this->get(route('classes.create'));
    $respCreate->assertStatus(200);
    $respCreate->assertSee('Aktif', false);
    $respCreate->assertDontSee('Nonaktif', false);

    $respEdit = $this->get(route('classes.edit', $class));
    $respEdit->assertStatus(200);
    $respEdit->assertSee('Aktif', false);
    $respEdit->assertDontSee('Nonaktif', false);
});
