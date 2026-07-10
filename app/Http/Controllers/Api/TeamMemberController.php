<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TeamMemberResource;
use App\Models\TeamMember;

class TeamMemberController extends AbstractContentController
{
    protected string $model = TeamMember::class;

    protected string $resource = TeamMemberResource::class;
}
