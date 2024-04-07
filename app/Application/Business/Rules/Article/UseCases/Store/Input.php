<?php

declare(strict_types=1);

namespace App\Application\Business\Rules\Article\UseCases\Store;

use DateTimeImmutable;
use App\Enterprise\Business\Rules\Article\Values\TagName;
use App\Enterprise\Business\Rules\Article\Values\AuthorId;

final class Input
{
    /**
     * @param TagName[] $tagNames
     */
    private function __construct(
        public readonly string $title,
        public readonly string $content,
        public readonly ?DateTimeImmutable $publishedAt,
        public readonly ?DateTimeImmutable $reservedAt,
        public readonly AuthorId $authorId,
        public readonly DateTimeImmutable $createdAt,
        public readonly array $tagNames,
    ) {

    }

    /**
     * @param int[] $tagIds
     */
    public static function create(
        string $title,
        string $content,
        bool $isPublish,
        bool $isReserve,
        ?string $reserveDate,
        ?string $reserveTime,
        int $authorId,
        DateTimeImmutable $createdAt,
        array $tagIds,
    ): self {
        $reservedAt = null;
        if ($reserveDate !== null && $reserveTime !== null) {
            $reservedAt = new DateTimeImmutable($reserveDate . ' ' . $reserveTime);
        }
        return new self(
            title: $title,
            content: $content,
            publishedAt: $isPublish ? $createdAt : null,
            reservedAt: !$isPublish && $isReserve ? $reservedAt : null,
            authorId: new AuthorId($authorId),
            createdAt: $createdAt,
            tagIds: array_map(fn(int $tagId) => new TagId($tagId), $tagIds),
        );
    }
}