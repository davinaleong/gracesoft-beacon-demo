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
    public function landing(): View
    {
        return view('landing', $this->formContext());
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

        return back()->with('submission_created', [
            'id' => $submission->id,
            'expires_at' => $submission->expires_at->toDayDateTimeString(),
        ]);
    }

    /**
     * @return array{retentionLabel: string}
     */
    private function formContext(): array
    {
        $retentionMinutes = max((int) config('beacon.retention_minutes', 24 * 60), 1);
        $retentionHours = intdiv($retentionMinutes, 60);

        $retentionLabel = $retentionMinutes < 60
            ? $retentionMinutes.' minute'.($retentionMinutes === 1 ? '' : 's')
            : ($retentionMinutes % 60 === 0
                ? $retentionHours.' hour'.($retentionHours === 1 ? '' : 's')
                : $retentionMinutes.' minutes');

        return [
            'retentionLabel' => $retentionLabel,
        ];
    }
}
