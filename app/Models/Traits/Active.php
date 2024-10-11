<?php

declare(strict_types = 1);

namespace App\Models\Traits;

trait Active
{
    public function scopeActive($query, bool $active = true): void
    {
        $query->where(function ($query) use ($active) {
            $table = with(new static())->getTable();

            if ($active) {
                $query->where($table . '.is_active', true)
                    ->orWhereNull($table . '.is_active');
            } else {
                $query->where($table . '.is_active', false);
            }
        });
    }
}
