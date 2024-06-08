<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmissionStoreRequest;
use App\Jobs\Submit;
use Illuminate\Http\JsonResponse;

class SubmissionController extends Controller
{
    public function submit(SubmissionStoreRequest $request): JsonResponse
    {
        Submit::dispatch($request->validated());

        return response()->json(['message' => 'The submission queued to be processed.'], 200);
    }
}
