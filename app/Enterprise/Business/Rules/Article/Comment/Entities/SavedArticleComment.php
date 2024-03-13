<?php

declare(strict_types=1);

namespace App\Enterprise\Business\Rules\Article\Coment\Entities;

use App\Enterprise\Business\Rules\Article\Entities\SavedArticle;

final class SavedArticleComment
{
    public function __construct(
        readonly public SavedArticle $savedArticle,
        readonly public ?string $contributor,
        readonly public string $text,
        readonly public \DateTimeImmutable $createdAt,
        readonly public \DateTimeImmutable $updatedAt,
    ) {
    }
}