<?php

namespace App\Http\Requests;

use App\Models\Article;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ArticleFormRequest extends FormRequest
{
    /**
     * 公開/下書きフラグ
     *
     * @var boolean
     */
    private $publish = false;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // TODO reserve = 1　の場合に reserve_date, reserve_time の入力チェックを行いたい
        return [
            'title'   => 'required|max:191',
            'content' => 'required|max:16383',
            'publish' => 'boolean',
            'reserve' => 'boolean',
        ];
    }

    /**
     * save Article.
     *
     * @param Article $article
     */
    public function save(Article $article)
    {
        $this->saveArticle($article);
        $this->saveTag($article);
    }

    /**
     * save Article function.
     *
     * @param [Article] $article
     *
     * @return void
     */
    private function saveArticle(Article $article)
    {
        $article->title = $this->input('title');
        $article->excerpt = $this->input('excerpt');
        $article->lb_content = $this->input('content');
        $article->publish = $this->publish;
        $article->author_id = Auth::user()->id;
        $article->reserve = $this->input('reserve');
        if ($article->reserve) {
            $article->post_date_time = Carbon::parse($this->input('reserve_date') . ' ' . $this->input('reserve_time'));
        } else {
            $article->post_date_time = date('Y/m/d H:i:s');
        }
        $article->save();
    }

    /**
     * save Tag function.
     *
     * @param [Article] $article
     *
     * @return void
     */
    private function saveTag(Article $article)
    {
        $tags = $this->input('tag');
        if ($tags != null) {
            $article->tags()->detach();
            foreach ($tags as $tag) {
                $addTag = Tag::find($tag);
                $article->tags()->save($addTag);
            }
        }

        $newTagNames = $this->input('new-tag-name');
        if ($newTagNames != null) {
            foreach ($newTagNames as $newTagName) {
                $newTag = new Tag();
                $newTag->name = $newTagName;
                $newTag->save();
                $article->tags()->save($newTag);
            }
        }
    }

    /**
     * 公開/下書きフラグを設定する.
     *
     * @param bolean $publish
     * @return void
     */
    public function setPublish($publish) {
        $this->publish = $publish;
    }
}
