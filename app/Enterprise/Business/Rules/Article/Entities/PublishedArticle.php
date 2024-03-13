<?php

declare(strict_types=1);

namespace App\Enterprise\Business\Rules\Article\Entities;

use App\Enterprise\Business\Rules\Article\Repositories\PublishedArticleCommand;

/**
 * 公開記事
 */
final class PublishedArticle
{
    private function __construct(
        readonly private int $id,
        private ?string $title,
        private ?string $content,
        private ?string $titleBeforeEditing,
        private ?string $contentBeforeEditing,
        private \DateTimeImmutable $publishedAt,
        private ?\DateTimeImmutable $reservedAt,
        readonly private \DateTimeImmutable $createdAt,
        readonly private \DateTimeImmutable $updatedAt,
    ) {
    }

    public static function convert(SavedArticle $savedArticle): self
    {
        return new self(
            $savedArticle->id,
            $savedArticle->title,
            $savedArticle->content,
            $savedArticle->titleBeforeEditing,
            $savedArticle->contentBeforeEditing,
            $savedArticle->publishedAt,
            $savedArticle->reservedAt,
            $savedArticle->createdAt,
            $savedArticle->updatedAt,
        );
    }

    public function save(PublishedArticleCommand $publishedArticleCommand): SavedArticle
    {
        return $publishedArticleCommand->save($this);
    }
}