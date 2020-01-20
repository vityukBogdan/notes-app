<?php

use Slim\App;

return function (App $app) {
    $app->get('/', \App\Action\HomeAction::class);

    $app->get('/notes', \App\Action\NotesAction::class);
    $app->get('/notes/{id:[0-9]+}', \App\Action\NotesViewAction::class);

    $app->post('/notes/add', \App\Action\NotesCreateAction::class);
    $app->options('/notes/add', \App\Action\PreflightAction::class);

    $app->put('/notes/update/{id:[0-9]+}', \App\Action\NotesUpdateAction::class);
    $app->options('/notes/update/{id:[0-9]+}', \App\Action\PreflightAction::class);

    $app->delete('/notes/delete/{id:[0-9]+}', \App\Action\NotesDeleteAction::class);
    $app->options('/notes/delete/{id:[0-9]+}', \App\Action\PreflightAction::class);
};