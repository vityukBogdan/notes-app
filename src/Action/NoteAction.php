<?php

namespace App\Action;

use App\Domain\Note\Data\NoteCreateData;
use App\Domain\Note\Service\NoteCreator;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class NoteAction
{
    private $noteCreator;

    public function __construct(NoteCreator $noteCreator)
    {
        $this->userCreator = $noteCreator;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array)$request->getParsedBody();

        // Mapping (should be done in a mapper class)
        $note = new NoteCreateData();
        $note->title = $data['username'];
        $note->text = $data['first_name'];

        // Invoke the Domain with inputs and retain the result
        $noteId = $this->userCreator->createUser($note);

        // Transform the result into the JSON representation
        $result = [
            'user_id' => $noteId
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}