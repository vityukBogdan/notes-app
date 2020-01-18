<?php

namespace App\Action;

use App\Domain\Note\Service\NoteService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class NotesViewAction
{
    private $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    public function __invoke(ServerRequest $request, Response $response, $args): Response
    {
        if (empty($args)) {
            return 1;
        }

        $note = $this->noteService->getNote($args['id']);

        return $response->withJson($note)->withStatus(200);
    }
}