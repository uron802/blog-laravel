<?php

declare(strict_types=1);

namespace App\Enterprise\Business\Rules\Article\Values;

final class TagName
{
    public function __construct(
        public readonly int $value,
    ) {
    }
}