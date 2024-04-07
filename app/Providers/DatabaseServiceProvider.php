<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Enterprise\Business\Rules\Article\Commands\UnStoredArticleCommand;
use App\Infrastructure\Database\Article\Commands\UnStoredArticleCommandImpl;

class DatabaseServiceProvider extends ServiceProvider
{
    public $bindings = [
        UnStoredArticleCommand::class => UnStoredArticleCommandImpl::class,
    ];
}
