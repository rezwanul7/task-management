<?php

namespace App\Traits;

trait PaginateAble
{
    protected int $pageSizeLimit = 50;

    public function getPerPage()
    {
        $perPage = request('per_page', $this->perPage);

        return min($perPage, $this->pageSizeLimit);
    }
}
