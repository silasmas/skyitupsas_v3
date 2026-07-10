<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AboutResource;
use App\Models\About;

class AboutController extends AbstractContentController
{
    protected string $model = About::class;

    protected string $resource = AboutResource::class;
}
