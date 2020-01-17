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
    public function getNotes()
    {
        $query = $this->queryFactory->newSelect('notes')->select('*');

        return $query->execute()->fetchAll('assoc');
    }

    /**
     * Insert user row.
     *
     * @param UserCreateData $user The user
     *
     * @return int The new ID
     */
    public function insertNote(UserCreateData $user): int
    {
        $row = [
            'username' => $user->username,
            'first_name' => $user->firstName,
            'last_name' => $user->lastName,
            'email' => $user->email,
        ];

        $sql = "INSERT INTO users SET 
                username=:username, 
                first_name=:first_name, 
                last_name=:last_name, 
                email=:email;";

        $this->connection->prepare($sql)->execute($row);

        return (int)$this->connection->lastInsertId();
    }

    public function updateNote(NoteCreateData $note): int
    {
        $values = ['email' => 'new@example.com'];

        $this->queryFactory->newUpdate('users')
            ->set($values)
            ->andWhere(['id' => 1])
            ->execute();
    }

    public function deleteNote(UserCreateData $user): int
    {
        $this->queryFactory->newDelete('users')
            ->andWhere(['id' => 1])
            ->execute();
    }
}