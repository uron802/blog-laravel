<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $guarded = ['id'];
    public static $rules = [
        'title'   => 'required|max:191',
        'text'    => 'required|max:16383',
        'publish' => 'boolean',
        'reserve' => 'boolean',
    ];

    protected $appends = ['reserve_date', 'reserve_time'];

    /**
     * 予約投稿日を取得.
     *
     * @return string 予約投稿日
     */
    public function getReserveDateAttribute()
    {
        if ($this->reserve) {
            return Carbon::parse($this->post_date_time)->format('Y-m-d');
        }
    }

    /**
     * 予約投稿時間を取得.
     *
     * @return string 予約投稿時間
     */
    public function getReserveTimeAttribute()
    {
        if ($this->reserve) {
            return Carbon::parse($this->post_date_time)->format('H:i');
        }
    }

    public function scopePublishEqual($query, $str)
    {
        return $query->where('publish', $str);
    }

    public function scopeReserve($query)
    {
        return $query->where('reserve', 0)->orWhere(function ($query) {
            $query->where('reserve', 1)->where('post_date_time', '<=', date('Y/m/d H:i:s'));
        });
    }

    /**
     * 記事のコメントを取得.
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'parent_article_id');
    }

    /**
     *記事のタグを取得.
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    /**
     * この記事の作者を取得.
     */
    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }
}
