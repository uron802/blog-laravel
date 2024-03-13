<?php

declare(strict_types=1);

namespace App\Enterprise\Business\Rules\Article\Repositories;

use App\Enterprise\Business\Rules\Article\Entities\SavedArticle;
use App\Enterprise\Business\Rules\Article\Entities\DraftedArticle;

interface DraftedArticleCommand
{
    public function save(DraftedArticle $draftedArticle): SavedArticle;
}