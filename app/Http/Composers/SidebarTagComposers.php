<?php

namespace App\Http\Composers;

use App\Models\Tag;
use Illuminate\View\View;

class SidebarTagComposers
{
    public function compose(View $view)
    {
        $sidebarTags = Tag::all();
        $view->with('sidebarTags', $sidebarTags);
    }
}
