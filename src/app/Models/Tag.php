<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $guarded = ['id'];
    public static $rules = [
        'name' => 'required|max:191',
    ];

    public function articles()
    {
        return $this->belongsToMany('App\Models\Article');
    }
}
