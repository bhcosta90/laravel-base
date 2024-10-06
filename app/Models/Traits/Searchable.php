<?php

declare(strict_types = 1);

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    public function scopeFilter(Builder $query, array $fields, array $search): void
    {
        $query->where(function (Builder $query) use ($fields, $search) {
            foreach ($search as $value) {
                $query->when($value, function (Builder $query) use ($fields, $value) {
                    $query->orWhereAny($fields, 'like', "{$value}%");
                });
            }
        });
    }
}
