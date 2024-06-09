<?php

namespace App\Http\Controllers;

use App\Exceptions\SubmissionProcessingException;
use App\Http\Requests\SubmissionStoreRequest;
use App\Services\SubmissionService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class SubmissionController extends Controller
{
    protected SubmissionService $submissionService;

    public function __construct(SubmissionService $submissionService)
    {
        $this->submissionService = $submissionService;
    }

    #[OA\Post(
        path: "/api/submit",
        summary: "Make a new submission",
        tags: ["Submissions"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "name", type: "string", example: "John Doe"),
                    new OA\Property(property: "email", type: "string", format: "email", example: "john.doe@example.com"),
                    new OA\Property(property: "message", type: "string", example: "This is a test message.")
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "The submission queued to be processed.",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "The submission queued to be processed.")
                    ]
                )
            ),
            new OA\Response(
                response: 422,
                description: "Validation errors",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "The name field is required. (and 2 more errors)"),
                        new OA\Property(
                            property: "errors",
                            type: "object",
                            properties: [
                                new OA\Property(property: "name", type: "array", items: new OA\Items(type: "string", example: "The name field is required.")),
                                new OA\Property(property: "email", type: "array", items: new OA\Items(type: "string", example: "The email field is required.")),
                                new OA\Property(property: "message", type: "array", items: new OA\Items(type: "string", example: "The message field is required."))
                            ]
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 500,
                description: "Internal server error",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Internal server error.")
                    ]
                )
            )
        ]
    )]
    public function submit(SubmissionStoreRequest $request): JsonResponse
    {
        try {
            $this->submissionService->processSubmission($request->validated());
        } catch (SubmissionProcessingException $e) {
            return response()->json(['error' => 'Error processing submission.'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal server error.'], 500);
        }

        return response()->json(['message' => 'The submission queued to be processed.'], 200);
    }
}
