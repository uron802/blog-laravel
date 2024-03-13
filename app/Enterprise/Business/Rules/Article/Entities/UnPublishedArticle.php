<?php

declare(strict_types=1);

namespace App\Enterprise\Business\Rules\Article\Entities;

use App\Enterprise\Business\Rules\Article\Repositories\UnPublishedArticleCommand;

/**
 * 未公開記事
 */
final class UnPublishedArticle
{
    private function __construct(
        private int $id,
        private ?string $title,
        private ?string $content,
        private ?\DateTimeImmutable $reservedAt,
        readonly public \DateTimeImmutable $createdAt,
        readonly public \DateTimeImmutable $updatedAt,
    ) {
    }

    public static function convert(SavedArticle $savedArticle): self
    {
        return new self(
            $savedArticle->id,
            $savedArticle->title,
            $savedArticle->content,
            $savedArticle->reservedAt,
            $savedArticle->createdAt,
            $savedArticle->updatedAt,
        );
    }

    public function save(UnPublishedArticleCommand $unPublishedArticleCommand): SavedArticle
    {
        return $unPublishedArticleCommand->save($this);
    }
}