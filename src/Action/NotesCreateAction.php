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
        $data = (array)$request->getParsedBody();

        print_r($request);
        print_r($data); die();

        $note = new NoteCreateData();
        $note->title = $data['title'];
        $note->text = $data['text'];

        $createdNote = $this->noteService->createNote($note);

        return $response->withJson($createdNote)->withStatus(200);
    }
}