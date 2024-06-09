<?php

namespace App\Strategies;

use App\Events\SubmissionSaved;
use App\Repositories\SubmissionRepository;

class DefaultSubmissionStrategy implements SubmissionStrategyInterface
{
    public function process(array $data, SubmissionRepository $repository)
    {
        $submission = $repository->create($data);
        event(new SubmissionSaved($submission));
    }
}
