<?php

use Slim\App;

return function (App $app) {
    $app->get('/', \App\Action\HomeAction::class);

    $app->get('/notes', \App\Action\NotesAction::class);
    $app->post('/notes/add', \App\Action\NotesCreateAction::class);
    $app->put('/notes/update/{id}', \App\Action\NotesUpdateAction::class);
    $app->delete('/notes/delete/{id}', \App\Action\NotesDeleteAction::class);
};