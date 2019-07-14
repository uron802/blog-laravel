<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $guarded = array('id');

    public static $rules = [
        'contributor' => 'required',
        'text' => 'required',
    ];
    /**
     * コメントに関連する記事レコードを取得
     */
    public function article()
    {
        return $this->belongsTo('App\Models\Article', 'parent_article_id');
    }
}
