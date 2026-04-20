<?php

use App\Models\Submission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('cleanup command removes expired submissions and files', function () {
    Storage::fake('local');

    $expired = Submission::factory()->create([
        'file_path' => 'private/submissions/expired.pdf',
        'expires_at' => now()->subHour(),
    ]);

    $active = Submission::factory()->create([
        'expires_at' => now()->addHours(12),
    ]);

    Storage::disk('local')->put('private/submissions/expired.pdf', 'expired-file');

    $this->artisan('beacon:cleanup')
        ->expectsOutput('Deleted 1 expired submissions.')
        ->assertSuccessful();

    expect(Submission::query()->whereKey($expired->id)->exists())->toBeFalse();
    expect(Submission::query()->whereKey($active->id)->exists())->toBeTrue();
    Storage::disk('local')->assertMissing('private/submissions/expired.pdf');
});
