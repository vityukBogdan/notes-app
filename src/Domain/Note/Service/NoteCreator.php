<?php

namespace App\Domain\Note\Service;

use App\Domain\Note\Data\NoteCreateData;
use App\Domain\Note\Repository\NoteRepository;
use UnexpectedValueException;

/**
 * Service.
 */
final class NoteCreator
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

    /**
     * Create a new note.
     *
     * @param NoteCreateData $note The note data
     *
     * @return int The new note ID
     */
    public function createNote(NoteCreateData $note): int
    {
        // Validation
        if (empty($note->title)) {
            throw new UnexpectedValueException('Title required');
        }

        // Insert note
        $noteId = $this->repository->insertNote($note);

        // Logging here: Note created successfully

        return $noteId;
    }
}