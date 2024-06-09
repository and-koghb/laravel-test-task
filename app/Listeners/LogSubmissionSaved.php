<?php

namespace App\Listeners;

use App\Events\SubmissionSaved;
use Illuminate\Support\Facades\Log;

class LogSubmissionSaved
{
    public function handle(SubmissionSaved $event): void
    {
        Log::info('Submission saved: ' . $event->submission->name . ' (' . $event->submission->email . ')');
    }
}
