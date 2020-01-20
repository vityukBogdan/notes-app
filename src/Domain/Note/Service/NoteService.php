<?php

namespace App\Domain\Note\Service;

use App\Domain\Note\Data\NoteCreateData;
use App\Domain\Note\Repository\NoteRepository;
use UnexpectedValueException;
use InvalidArgumentException;
use LengthException;

/**
 * NoteService.
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
        if (empty($id)) {
            throw new InvalidArgumentException('Id required');
        }

        return $this->repository->getNote($id);
    }

    /**
     * Create a new note.
     *
     * @param NoteCreateData $note The note data
     *
     * @return int The new note ID
     */
    public function createNote(NoteCreateData $note): int
    {
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
     * @return bool
     */
    public function updateNote($id, NoteCreateData $note): bool
    {
        if (empty($note->title)) {
            throw new UnexpectedValueException('Title required');
        }

        if (strlen($note->title) > 64) {
            throw new LengthException('The title is too long');
        }

        return $this->repository->updateNote($id, $note);
    }

    /**
     * Delete note.
     *
     * @param $id
     *
     * @return bool
     */
    public function deleteNote($id): bool
    {
        if (empty($id)) {
            throw new InvalidArgumentException('Id required');
        }

        return $this->repository->deleteNote($id);
    }
}