<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubmissionRequest;
use App\Models\Submission;
use Illuminate\Http\RedirectResponse;
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

        $filePath = null;

        if ($request->hasFile('attachment')) {
            $extension = $request->file('attachment')->getClientOriginalExtension();
            $filePath = $request->file('attachment')->storeAs(
                'private/submissions',
                sprintf('%s.%s', (string) Str::uuid(), $extension),
                'local',
            );
        }

        $submission = Submission::query()->create([
            'name' => $validated['name'] ?? null,
            'email' => $validated['email'] ?? null,
            'message' => $validated['message'],
            'file_path' => $filePath,
            'expires_at' => now()->addHours(24),
        ]);

        return to_route('submit.create')->with('submission_created', [
            'id' => $submission->id,
            'expires_at' => $submission->expires_at->toDayDateTimeString(),
        ]);
    }
}
