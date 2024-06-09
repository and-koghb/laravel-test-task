<?php

namespace App\Strategies;

use App\Repositories\SubmissionRepository;

interface SubmissionStrategyInterface
{
    public function process(array $data, SubmissionRepository $repository);
}
