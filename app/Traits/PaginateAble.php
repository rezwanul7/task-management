<?php

namespace App\Traits;

trait PaginateAble
{
    public function scopeApplyPaginateAble($query, $perPage = null, $limit = 50)
    {
        if (empty($perPage)) {
            $perPage = (int) request()->input('per_page', 10);
            if ($perPage > $limit) {
                $perPage = $limit;
            }
        }

        return $query->paginate($perPage);
    }
}
