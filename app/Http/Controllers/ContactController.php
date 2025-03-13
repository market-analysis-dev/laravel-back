<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexContactRequest;
use App\Models\Contact;
use App\Responses\ApiResponse;

class ContactController extends ApiController
{
    public function index(IndexContactRequest $request): ApiResponse
    {
        $validated = $request->validated();

        $size = $validated['size'] ?? 25;
        $order = $validated['column'] ?? 'id';
        $direction = $validated['state'] ?? 'desc';

        $contacts = Contact::with([
            'buildings',
            'lands',
            'companies'
        ])
        ->filter($validated)
        ->orderBy($order, $direction)
        ->paginate($size);

        return $this->success(data: $contacts);
    }

    public function show(Contact $contact): ApiResponse
    {
        $contact->load([
            'buildings',
            'lands',
            'companies'
        ]);
        return $this->success(data: $contact);
    }
}
