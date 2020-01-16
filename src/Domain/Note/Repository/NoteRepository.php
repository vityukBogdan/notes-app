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
}