<?php

namespace App\Domain\Note\Repository;

use App\Domain\Note\Data\NoteCreateData;
use App\Repository\QueryFactory;
use App\Repository\TableName;

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
     * @param $id
     *
     * @return array Note rows
     */
    public function getNote($id): array
    {
        $query = $this->queryFactory->newSelect('notes');

        $query->select('*')->andWhere(['note_id' => $id]);

        return $query->execute()->fetch('assoc');
    }

    /**
     * Insert note row.
     *
     * @param NoteCreateData $note The note
     *
     * @return int The new note
     */
    public function insertNote(NoteCreateData $note): int
    {
        $values = [
            'title' => $note->title,
            'text' => $note->text,
        ];

        $query = $this->queryFactory->newInsert('notes', $values);

        return $query->execute()->lastInsertId();
    }

    /**
     * Update note rows.
     *
     * @param $id
     * @param NoteCreateData $note The note
     *
     * @return bool If successfully updated: true
     */
    public function updateNote($id, NoteCreateData $note): bool
    {
        $values = [
            'title' => $note->title,
            'text' => $note->text,
            'update_time' => date('Y-m-d H:i:s')
        ];

        $save = $this->queryFactory->newUpdate('notes')
            ->set($values)
            ->andWhere(['note_id' => $id])
            ->execute();

        return $save ? true : false;
    }

    /**
     * Delete note.
     *
     * @param $id
     *
     * @return bool If successfully deleted: true
     */
    public function deleteNote($id): bool
    {
        $delete = $this->queryFactory->newDelete('notes')
            ->andWhere(['note_id' => $id])
            ->execute();

        return $delete ? true : false;
    }
}