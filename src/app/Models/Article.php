<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $guarded = array('id');
    public static $rules = [
        'title' => 'required|max:191',
        'text' => 'required|max:16383',
        'publish' => 'boolean',
    ];
    public function scopePublishEqual($query, $str)
    {
        return $query->where('publish', $str);
    }
    /**
     * 記事のコメントを取得
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'parent_article_id');
    }
}
