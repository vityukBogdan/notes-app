<?php

namespace App\Domain\Note\Repository;

use App\Domain\Note\Data\NoteCreateData;
use App\Repository\QueryFactory;
use App\Repository\TableName;
use Cake\Database\StatementInterface;

/**
 * Repository.
 */
class NoteRepository
{
    /**
     * @var QueryFactory The query factory
     */
    private $queryFactory;

    /**
     * The constructor.
     *
     * @param QueryFactory $queryFactory The query factory
     */
    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    /**
     * @return array Notes rows
     */
    public function getNotes(): array
    {
        $query = $this->queryFactory->newSelect('notes')->select('*');

        return $query->execute()->fetchAll('assoc');
    }

    /**
     * @return array Note row
     */
    public function getNote($id): array
    {
        $query = $this->queryFactory->newSelect('notes');

        $query->select('*')->andWhere(['note_id' => $id]);

        return $query->execute()->fetch('assoc');
    }

    /**
     * Insert user row.
     *
     * @param NoteCreateData $note The note
     *
     * @return array The new note
     */
    public function insertNote(NoteCreateData $note): array
    {
        $values = [
            'title' => $note->title,
            'text' => $note->text,
        ];

        $query = $this->queryFactory->newInsert('notes', $values);

        return $query->execute()->fetch('assoc');
    }

    public function updateNote($id, NoteCreateData $note): int
    {
        $values = [
            'title' => $note->title,
            'text' => $note->text,
        ];

        $this->queryFactory->newUpdate('notes')
            ->set($values)
            ->andWhere(['id' => $id])
            ->execute();
    }

    public function deleteNote($id, UserCreateData $user): int
    {
        $this->queryFactory->newDelete('users')
            ->andWhere(['id' => $id])
            ->execute();
    }
}