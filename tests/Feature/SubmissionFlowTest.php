<?php

use App\Models\Submission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('submit page is accessible', function () {
    $this->get(route('submit.create'))->assertSuccessful();
});

test('visitor can create a submission with attachment', function () {
    Storage::fake('local');

    $response = $this->post(route('submit.store'), [
        'name' => 'Demo User',
        'email' => 'demo@example.com',
        'message' => 'This is only demo data.',
        'attachment' => UploadedFile::fake()->create('notes.pdf', 100, 'application/pdf'),
        'website' => '',
    ]);

    $response->assertStatus(302);

    expect(Submission::query()->count())->toBe(1);

    $submission = Submission::query()->first();

    expect($submission)->not->toBeNull();
    expect($submission->message)->toBe('This is only demo data.');
    expect($submission->expires_at->isFuture())->toBeTrue();

    Storage::disk('local')->assertExists($submission->file_path);
});

test('submission requires a message and rejects invalid file type', function () {
    $response = $this->from(route('submit.create'))->post(route('submit.store'), [
        'name' => 'Demo User',
        'email' => 'demo@example.com',
        'message' => '',
        'attachment' => UploadedFile::fake()->create('notes.exe', 100, 'application/octet-stream'),
        'website' => '',
    ]);

    $response->assertRedirect(route('submit.create'));
    $response->assertSessionHasErrors(['message', 'attachment']);
});
