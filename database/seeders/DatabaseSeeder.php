<?php

namespace Database\Seeders;

use App\Models\Submission;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@beacon-demo.test'],
            [
                'name' => 'Beacon Demo Admin',
                'password' => 'password',
            ],
        );

        if (Submission::query()->count() === 0) {
            Submission::factory()->count(6)->create();
        }
    }
}
