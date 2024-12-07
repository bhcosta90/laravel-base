<?php

declare(strict_types = 1);

namespace App\Enum;

enum Queue: string
{
    case High        = 'high';
    case Low         = 'low';
    case LongTimeout = 'long-timeout';
}
