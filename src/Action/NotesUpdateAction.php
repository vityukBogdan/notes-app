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

        $note = new NoteCreateData();
        $note->title = $data['title'];
        $note->text = $data['text'];

        $this->noteService->updateNote($args['id'], $note);

        return $response->withJson(['success'])->withStatus(200);
    }
}