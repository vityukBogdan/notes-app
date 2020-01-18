<?php

namespace App\Action;

use App\Domain\Note\Data\NoteCreateData;
use App\Domain\Note\Service\NoteService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class NotesUpdateAction
{
    private $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    public function __invoke(ServerRequest $request, Response $response, $args): Response
    {
        $data = (array)$request->getParsedBody();

        // Mapping (should be done in a mapper class)
        $note = new NoteCreateData();
        $note->title = $data['title'];
        $note->text = $data['text'];

        // Invoke the Domain with inputs and retain the result
        $noteId = $this->noteService->updateNote($args['id'], $note);

        // Transform the result into the JSON representation
        $result = [
            'data' => $noteId
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(200);
    }
}