<?php

namespace App\Jobs;

use App\Events\SubmissionSaved;
use App\Repositories\SubmissionRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Submit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $data;
    protected SubmissionRepository $submissionRepository;

    public function __construct(array $data, SubmissionRepository $submissionRepository)
    {
        $this->data = $data;
        $this->submissionRepository = $submissionRepository;
    }

    public function handle(): void
    {
        $submission = $this->submissionRepository->create($this->data);
        event(new SubmissionSaved($submission));
    }
}
