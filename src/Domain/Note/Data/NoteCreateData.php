<?php

namespace App\Domain\Note\Data;

final class NoteCreateData
{
    /** @var string */
    public $title;

    /** @var string */
    public $text;

    /** @var string */
    public $create_time;

    /** @var string */
    public $update_time;
}