<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AdminSubmissionController extends Controller
{
    public function index(): View
    {
        $submissions = Submission::query()
            ->latest('created_at')
            ->paginate(12);

        return view('admin.submissions.index', [
            'submissions' => $submissions,
        ]);
    }

    public function show(Submission $submission): View
    {
        return view('admin.submissions.show', [
            'submission' => $submission,
        ]);
    }

    public function downloadFile(Submission $submission): BinaryFileResponse
    {
        abort_unless($submission->file_path, 404);
        abort_unless(Storage::disk('local')->exists($submission->file_path), 404);

        return response()->download(Storage::disk('local')->path($submission->file_path));
    }

    public function destroy(Submission $submission): RedirectResponse
    {
        if ($submission->file_path && Storage::disk('local')->exists($submission->file_path)) {
            Storage::disk('local')->delete($submission->file_path);
        }

        $submission->delete();

        return to_route('admin.submissions.index')->with('status', 'Submission deleted.');
    }
}
