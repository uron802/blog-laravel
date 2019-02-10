<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $guarded = array('id');
    public static $rules = [
        'title' => 'required',
        'text' => 'required',
        'publish' => 'boolean',
    ];
    public function scopePublishEqual($query, $str)
    {
        return $query->where('publish', $str);
    }
}
