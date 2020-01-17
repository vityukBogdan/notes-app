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

        $note = $this->repository->insertNote($note);

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
    public function updateNote($id, NoteCreateData $note): int
    {
        // Validation
        if (empty($note->title)) {
            throw new UnexpectedValueException('Title required');
        }

        $note = $this->repository->updateNote($note);

        // Logging here: Note created successfully

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
    public function deleteNote($id): int
    {
        // Insert note
        $noteId = $this->repository->deletetNote($id);

        // Logging here: Note created successfully

        return $noteId;
    }
}