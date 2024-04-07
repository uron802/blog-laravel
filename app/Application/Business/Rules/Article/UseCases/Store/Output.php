<?php

declare(strict_types=1);

namespace App\Application\Business\Rules\Article\UseCases\Store;

use App\Enterprise\Business\Rules\Article\Values\ArticleId;

final class Output
{
    public function __construct(
        public readonly ArticleId $articleId,
    ) {

    }
}