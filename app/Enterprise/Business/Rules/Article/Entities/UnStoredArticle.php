<?php

declare(strict_types=1);

namespace App\Enterprise\Business\Rules\Article\Entities;

use App\Enterprise\Business\Rules\Article\Values\ArticleId;
use App\Enterprise\Business\Rules\Article\Values\AuthorId;
use App\Enterprise\Business\Rules\Article\Values\TagName;
use App\Enterprise\Business\Rules\Article\Commands\UnStoredArticleCommand;

/**
 * 未作成記事
 */
final class UnStoredArticle
{
    private ?ArticleId $articleId;

    /**
     * @param TagName[] $tagNames
     */
    public function __construct(
        public readonly string $title,
        public readonly string $content,
        public readonly ?\DateTimeImmutable $publishedAt,
        public readonly ?\DateTimeImmutable $reservedAt,
        public readonly AuthorId $authorId,
        public readonly \DateTimeImmutable $createdAt,
        public readonly array $tagNames,
    ) {
        $this->articleId = null;
    }

    public function save(
        UnStoredArticleCommand $unStoredArticleCommand
    ): void {
        $this->articleId = $unStoredArticleCommand->saveArticle($this);
        $unStoredArticleCommand->saveTags($this->articleId, $this->tagNames);
    }

    public function getArticleId(): ?ArticleId
    {
        return $this->articleId;
    }
}