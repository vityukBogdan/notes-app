<?php

namespace App\Action;

use App\Domain\Note\Service\NoteService;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class NotesAction
{
    private $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        $notes = $this->noteService->getNotes();

        return $response->withJson($notes)->withStatus(200);
    }
}