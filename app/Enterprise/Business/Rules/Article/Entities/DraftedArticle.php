<?php

declare(strict_types=1);

namespace App\Enterprise\Business\Rules\Article\Entities;

use App\Enterprise\Business\Rules\Article\Repositories\DraftedArticleCommand;

/**
 * 下書き記事
 */
final class DraftedArticle
{
    private function __construct(
        readonly private int $id,
        private ?string $title,
        private ?string $content,
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
            $savedArticle->createdAt,
            $savedArticle->updatedAt,
        );
    }

    public function edit(?string $title, ?string $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function save(DraftedArticleCommand $draftedArticleCommand): SavedArticle
    {
        return $draftedArticleCommand->save($this);
    }
}