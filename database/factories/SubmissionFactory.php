<?php

namespace Database\Factories;

use App\Models\Submission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Submission>
 */
class SubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $retentionMinutes = max((int) config('beacon.retention_minutes', 24 * 60), 1);

        return [
            'name' => fake()->boolean(70) ? fake()->name() : null,
            'email' => fake()->boolean(65) ? fake()->safeEmail() : null,
            'message' => fake()->paragraphs(2, true),
            'file_path' => null,
            'expires_at' => now()->addMinutes($retentionMinutes),
        ];
    }
}
