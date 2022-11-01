<?php

namespace App\Domain\Comment\DataTransferObjects;

class CreateCommentData extends \Spatie\DataTransferObject\DataTransferObject
{
    public string $content;
}
