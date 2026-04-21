<?php

use App\Models\Submission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('submit page redirects to landing demo form', function () {
    $this->get(route('submit.create'))->assertRedirect('/#demo-form');
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
    $response = $this->from(route('landing'))->post(route('submit.store'), [
        'name' => 'Demo User',
        'email' => 'demo@example.com',
        'message' => '',
        'attachment' => UploadedFile::fake()->create('notes.exe', 100, 'application/octet-stream'),
        'website' => '',
    ]);

    $response->assertRedirect(route('landing'));
    $response->assertSessionHasErrors(['message', 'attachment']);
});

test('submission expiry uses configured retention minutes', function () {
    Config::set('beacon.retention_minutes', 30);

    $this->post(route('submit.store'), [
        'name' => 'Demo User',
        'email' => 'demo@example.com',
        'message' => 'Configured retention check.',
        'website' => '',
    ])->assertStatus(302);

    $submission = Submission::query()->latest('created_at')->first();

    expect($submission)->not->toBeNull();
    expect((int) abs($submission->expires_at->diffInMinutes($submission->created_at)))->toBe(30);
});
