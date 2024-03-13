<?php

declare(strict_types=1);

namespace App\Enterprise\Business\Rules\Article\Entities;

use App\Enterprise\Business\Rules\Article\Repositories\UnCreatedArticleCommand;

/**
 * 未作成記事
 */
final class UnCreatedArticle
{
    public function __construct(
        private ?string $title,
        private ?string $content,
    ) {
    }

    public function save(UnCreatedArticleCommand $unCreatedArticleCommand): SavedArticle
    {
        return $unCreatedArticleCommand->save($this);
    }
}