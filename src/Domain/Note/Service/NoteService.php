<?php

namespace App\Domain\Note\Service;

use App\Domain\Note\Data\NoteCreateData;
use App\Domain\Note\Repository\NoteRepository;
use UnexpectedValueException;

/**
 * Service.
 */
final class NoteService
{
    /**
     * @var NoteRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param NoteRepository $repository The repository
     */
    public function __construct(NoteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getNotes()
    {
        return $this->repository->getNotes();
    }

    public function getNote($id)
    {
        return $this->repository->getNote($id);
    }

    /**
     * Create a new note.
     *
     * @param NoteCreateData $note The note data
     *
     * @return int The new note ID
     */
    public function createNote(NoteCreateData $note): array
    {
        print_r($note); die();
        if (empty($note->title)) {
            throw new UnexpectedValueException('Title required');
        }

        if (strlen($note->title) > 64) {
            throw new UnexpectedValueException('The title is too long');
        }

        return $this->repository->insertNote($note);
    }

    /**
     * Update a new note.
     *
     * @param $id
     * @param NoteCreateData $note The note data
     *
     * @return int The new note ID
     */
    public function updateNote($id, NoteCreateData $note): int
    {
        // Validation
        if (empty($note->title)) {
            throw new UnexpectedValueException('Title required');
        }

        $note = $this->repository->updateNote($id, $note);

        return $note;
    }

    /**
     * Update a new note.
     *
     * @param $id
     * @param NoteCreateData $note The note data
     *
     * @return int The new note ID
     */
    public function deleteNote($id): array
    {
        $note = $this->repository->deletetNote($id);

        return $note;
    }
}