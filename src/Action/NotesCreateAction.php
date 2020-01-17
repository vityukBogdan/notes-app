<?php

namespace App\Action;

use App\Domain\Note\Data\NoteCreateData;
use App\Domain\Note\Service\NoteService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class NotesCreateAction
{
    private $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array)$request->getParsedBody();

        // Mapping (should be done in a mapper class)
        $note = new NoteCreateData();
        $note->title = $data['title'];
        $note->text = $data['text'];

        $noteId = $this->noteService->createNote($note);

        // Transform the result into the JSON representation
        $result = [
            'data' => $noteId
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}