<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubmissionRequest;
use App\Models\Submission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SubmissionController extends Controller
{
    public function create(): View
    {
        return view('submit.create');
    }

    public function store(StoreSubmissionRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $retentionMinutes = (int) config('beacon.retention_minutes', 24 * 60);

        $filePath = null;
        $attachment = $validated['attachment'] ?? null;

        if ($attachment instanceof UploadedFile && $attachment->isValid() && $attachment->getRealPath()) {
            $extension = $attachment->getClientOriginalExtension() ?: $attachment->extension();
            $filename = (string) Str::uuid();

            if (filled($extension)) {
                $filename .= '.'.$extension;
            }

            $filePath = $attachment->storeAs(
                'private/submissions',
                $filename,
                'local',
            );
        }

        $submission = Submission::query()->create([
            'name' => $validated['name'] ?? null,
            'email' => $validated['email'] ?? null,
            'message' => $validated['message'],
            'file_path' => $filePath,
            'expires_at' => now()->addMinutes(max($retentionMinutes, 1)),
        ]);

        return to_route('submit.create')->with('submission_created', [
            'id' => $submission->id,
            'expires_at' => $submission->expires_at->toDayDateTimeString(),
        ]);
    }
}
