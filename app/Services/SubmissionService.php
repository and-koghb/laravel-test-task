<?php

namespace App\Services;

use App\Exceptions\SubmissionProcessingException;
use App\Jobs\Submit;
use App\Repositories\SubmissionRepository;
use Illuminate\Support\Facades\Log;

class SubmissionService
{
    protected SubmissionRepository $submissionRepository;

    public function __construct(SubmissionRepository $submissionRepository)
    {
        $this->submissionRepository = $submissionRepository;
    }

    public function processSubmission(array $data)
    {
        try {
            Submit::dispatch($data, $this->submissionRepository);
        } catch (\Exception $e) {
            Log::error('Error processing submission: ' . $e->getMessage());
            throw new SubmissionProcessingException('Error processing submission: ' . $e->getMessage());
        }
    }
}
