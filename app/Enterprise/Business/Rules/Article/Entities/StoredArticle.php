<?php

declare(strict_types=1);

namespace App\Enterprise\Business\Rules\Article\Entities;

final class StoredArticle
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly string $content,
        public readonly ?string $titleBeforeEditing,
        public readonly ?string $contentBeforeEditing,
        public readonly ?\DateTimeImmutable $publishedAt,
        public readonly ?\DateTimeImmutable $reservedAt,
        public readonly int $authorId,
        public readonly \DateTimeImmutable $createdAt,
        public readonly \DateTimeImmutable $updatedAt,
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