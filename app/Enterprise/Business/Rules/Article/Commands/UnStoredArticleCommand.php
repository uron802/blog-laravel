<?php

declare(strict_types=1);

namespace App\Enterprise\Business\Rules\Article\Commands;

use App\Enterprise\Business\Rules\Article\Values\ArticleId;
use App\Enterprise\Business\Rules\Article\Values\TagName;
use App\Enterprise\Business\Rules\Article\Entities\UnStoredArticle;

interface UnStoredArticleCommand
{
    public function begin(): void;

    public function commit(): void;

    public function rollback(): void;

    public function saveArticle(UnStoredArticle $unStoredArticle): ArticleId;

    /**
     * @param TagName[] $tagNames
     */
    public function saveTags(ArticleId $articleId, array $tagNames): void;
}