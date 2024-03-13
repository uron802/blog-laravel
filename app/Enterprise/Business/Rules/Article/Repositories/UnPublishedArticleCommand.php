<?php

declare(strict_types=1);

namespace App\Enterprise\Business\Rules\Article\Repositories;

use App\Enterprise\Business\Rules\Article\Entities\SavedArticle;
use App\Enterprise\Business\Rules\Article\Entities\UnPublishedArticle;

interface UnPublishedArticleCommand
{
    public function save(UnPublishedArticle $unPublishedArticle): SavedArticle;
}