<?php

declare(strict_types=1);

namespace App\Infrastructure\Database\Article\Commands;

use App\Models\Tag;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use App\Enterprise\Business\Rules\Article\Values\TagName;
use App\Enterprise\Business\Rules\Article\Values\ArticleId;
use App\Enterprise\Business\Rules\Article\Entities\UnStoredArticle;
use App\Enterprise\Business\Rules\Article\Commands\UnStoredArticleCommand;

final class UnStoredArticleCommandImpl implements UnStoredArticleCommand
{

    public function begin(): void
    {
        DB::beginTransaction();
    }

    public function commit(): void
    {
        DB::commit();
    }

    public function rollback(): void
    {
        DB::rollBack();
    }

    public function saveArticle(UnStoredArticle $unStoredArticle): ArticleId
    {
        $article = Article::create([
            'title' => $unStoredArticle->title,
            'content' => $unStoredArticle->content,
            'publish' => $unStoredArticle->publishedAt === null ? false : true,
            'author_id' => $unStoredArticle->authorId->value,
            'reserve' => $unStoredArticle->reservedAt === null ? false : true,
            'post_date_time' => $unStoredArticle->createdAt
        ]);
        $article->saveOrFail();
        return new ArticleId($article->id);
    }

    /**
     * @param TagName[] $tagNames
     */
    public function saveTags(ArticleId $articleId, array $tagNames): void
    {
        $tagNameValues = array_map(fn(TagName $tagName) => $tagName->value, $tagNames);
        $newTagNameValues = array_filter(Tag::whereIn('name', $tagNameValues)->get(['name']), fn(Tag $tag) => !in_array($tag['name'], $tagNameValues));
        Tag::insert(
            array_map(fn(string $tagNameValue) => [
                'name' => $tagNameValue,
            ], $newTagNameValues)
        );
        DB::table('article_tag')
            ->where('article_id', '=', $articleId->value)
            ->delete();
        DB::table('article_tag')->insert(
            array_map(fn(Tag $tag) => [
                'article_id' => $articleId->value,
                'tag_id' => $tag['id'],
            ], Tag::whereIn('name', array_merge($tagNameValues, $newTagNameValues))->get(['id']))
        );
    }
}