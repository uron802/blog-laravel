<?php

declare(strict_types=1);

namespace App\Enterprise\Business\Rules\Article\Entities;

final class SavedArticle
{
    public function __construct(
        readonly public int $id,
        readonly public ?string $title,
        readonly public ?string $content,
        readonly public ?string $titleBeforeEditing,
        readonly public ?string $contentBeforeEditing,
        readonly public ?\DateTimeImmutable $publishedAt,
        readonly public ?\DateTimeImmutable $reservedAt,
        readonly public \DateTimeImmutable $createdAt,
        readonly public \DateTimeImmutable $updatedAt,
    ) {
    }

    public function iPublished(): bool
    {
        return $this->publishedAt !== null;
    }

    public function isReserved(): bool
    {
        return $this->reservedAt !== null;
    }
}