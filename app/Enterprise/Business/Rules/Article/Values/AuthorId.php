<?php

declare(strict_types=1);

namespace App\Enterprise\Business\Rules\Article\Values;

use App\Enterprise\Business\Rules\Article\Entities\Author;
use App\Enterprise\Business\Rules\Article\Repositories\StoredAuthorQuery;

final class AuthorId
{
    public function __construct(
        public readonly int $value,
    ) {
    }

    public function getAuthor(StoredAuthorQuery $query): Author
    {
        return $query->restore($this->value);
    }
}