<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ServiceResource;
use App\Models\Service;

class ServiceController extends AbstractContentController
{
    protected string $model = Service::class;

    protected string $resource = ServiceResource::class;
}
