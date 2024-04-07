<?php

declare(strict_types=1);

namespace App\Application\Business\Rules\Article\UseCases\Store;

use Throwable;
use App\Enterprise\Business\Rules\Article\Entities\UnStoredArticle;
use App\Enterprise\Business\Rules\Article\Commands\UnStoredArticleCommand;

final class Interactor
{
    public function __construct(
        public readonly UnStoredArticleCommand $unStoredArticleCommand
    ) {
    }

    public function execute(Input $input): Output
    {
        $this->unStoredArticleCommand->begin();
        try {
            $article = new UnStoredArticle(
                title: $input->title,
                content: $input->content,
                publishedAt: $input->publishedAt,
                reservedAt: $input->reservedAt,
                authorId: $input->authorId,
                createdAt: $input->createdAt,
                tagNames: $input->tagNames,
            );
            $article->save($this->unStoredArticleCommand);
            $this->unStoredArticleCommand->commit();
        } catch (Throwable $throwable) {
            $this->unStoredArticleCommand->rollback();
            throw $throwable;
        }

        return new Output(
            articleId: $article->getArticleId()
        );
    }
}