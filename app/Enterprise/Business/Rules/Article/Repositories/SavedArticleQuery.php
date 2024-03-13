<?php

declare(strict_types=1);

namespace App\Enterprise\Business\Rules\Article\Repositories;

use App\Enterprise\Business\Rules\Article\Entities\SavedArticle;

interface SavedArticleQuery
{
    public function restore(int $id): SavedArticle;
}