<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ContactResource;
use App\Models\Contact;

class ContactController extends AbstractContentController
{
    protected string $model = Contact::class;

    protected string $resource = ContactResource::class;
}
