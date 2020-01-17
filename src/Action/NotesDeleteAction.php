<?php

namespace App\Action;

use App\Domain\Note\Data\NoteCreateData;
use App\Domain\Note\Service\NoteService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class NotesDeleteAction
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

        $id = 1;

        $noteId = $this->noteService->deleteNote($id);

        // Transform the result into the JSON representation
        $result = [
            'data' => $noteId
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}