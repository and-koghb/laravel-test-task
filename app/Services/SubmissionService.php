<?php

namespace App\Services;

use App\Exceptions\SubmissionProcessingException;
use App\Jobs\Submit;
use App\Repositories\SubmissionRepository;
use App\Strategies\SubmissionStrategyInterface;
use Illuminate\Support\Facades\Log;

class SubmissionService
{
    protected SubmissionStrategyInterface $submissionStrategy;

    protected SubmissionRepository $submissionRepository;

    public function __construct(SubmissionStrategyInterface $submissionStrategy, SubmissionRepository $submissionRepository)
    {
        $this->submissionStrategy = $submissionStrategy;
        $this->submissionRepository = $submissionRepository;
    }

    public function processSubmission(array $data)
    {
        try {
            Submit::dispatch($data, $this->submissionStrategy, $this->submissionRepository);
        } catch (\Exception $e) {
            Log::error('Error processing submission: ' . $e->getMessage());
            throw new SubmissionProcessingException('Error processing submission: ' . $e->getMessage());
        }
    }
}
