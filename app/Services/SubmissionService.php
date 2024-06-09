<?php

namespace App\Services;

use App\Jobs\Submit;
use App\Repositories\SubmissionRepository;

class SubmissionService
{
    protected SubmissionRepository $submissionRepository;

    public function __construct(SubmissionRepository $submissionRepository)
    {
        $this->submissionRepository = $submissionRepository;
    }

    public function processSubmission(array $data)
    {
        Submit::dispatch($data, $this->submissionRepository);
    }
}
