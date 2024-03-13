<?php

declare(strict_types=1);

namespace App\Enterprise\Business\Rules\Article\Comment\Entities;

/**
 * 未作成記事
 */
final class UnCreatedArticleComment
{
    public function __construct(
        private ?string $contributor,
        private string $text,
    ) {
    }
}