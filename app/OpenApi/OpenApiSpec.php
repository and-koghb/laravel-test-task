<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\OpenApi(
info: new OA\Info(
    title: "Laravel Test Task API",
        version: "1.0.0",
        description: "A short description of your API"
    )
)]

class OpenApiSpec
{
}

