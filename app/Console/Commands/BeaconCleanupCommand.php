<?php

namespace App\Console\Commands;

use App\Models\Submission;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

#[Signature('beacon:cleanup')]
#[Description('Delete expired demo submissions and their stored files')]
class BeaconCleanupCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $expiredSubmissions = Submission::query()
            ->where('expires_at', '<=', now())
            ->get();

        foreach ($expiredSubmissions as $submission) {
            if ($submission->file_path && Storage::disk('local')->exists($submission->file_path)) {
                Storage::disk('local')->delete($submission->file_path);
            }

            $submission->delete();
        }

        $this->info(sprintf('Deleted %d expired submissions.', $expiredSubmissions->count()));

        return self::SUCCESS;
    }
}
