<?php

namespace App\Filters;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Pagination
{
    public function pagination($products, $count)
    {
        $perPage = $count;
        $page = null;
        $options = [];

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $products instanceof Collection ? $products : Collection::make($products);

        return new LengthAwarePaginator(array_values(
            $items
                ->forPage($page, $perPage)
                ->toArray()),
            $items->count(),
            $perPage,
            $page,
            $options
        );
    }

    public function links($total, $perPage)
    {
        return ceil($total / $perPage);
    }
}
