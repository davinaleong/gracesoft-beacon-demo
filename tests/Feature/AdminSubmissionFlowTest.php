<?php

use App\Models\Submission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('admin submissions page requires authentication', function () {
    $this->get(route('admin.submissions.index'))
        ->assertRedirect(route('admin.login'));
});

test('admin can login and view submissions', function () {
    $user = User::factory()->create([
        'email' => 'admin@beacon-demo.test',
        'password' => 'password',
    ]);

    Submission::factory()->create();

    $response = $this->post(route('admin.login.store'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertRedirect(route('admin.submissions.index'));

    $this->get(route('admin.submissions.index'))->assertSuccessful();
});

test('admin can delete submission and its file', function () {
    Storage::fake('local');

    $user = User::factory()->create();
    $submission = Submission::factory()->create([
        'file_path' => 'private/submissions/demo.pdf',
    ]);

    Storage::disk('local')->put('private/submissions/demo.pdf', 'demo-file');

    $this->actingAs($user)
        ->delete(route('admin.submissions.destroy', $submission))
        ->assertRedirect(route('admin.submissions.index'));

    expect(Submission::query()->whereKey($submission->id)->exists())->toBeFalse();
    Storage::disk('local')->assertMissing('private/submissions/demo.pdf');
});
