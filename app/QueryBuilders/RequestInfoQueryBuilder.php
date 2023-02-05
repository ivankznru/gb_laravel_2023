<?php

namespace App\QueryBuilders;

use App\Models\Request_info;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

final class RequestInfoQueryBuilder extends QueryBuilder
{
    public Builder $model;

    public function __construct()
    {
        $this->model = Request_info::query();
    }

    public function getRequestInfoWithPagination(int $quantity = 10): LengthAwarePaginator
    {
        return $this->model->paginate($quantity);
    }

    public function getAll(): Collection
    {
        return $this->model->get();
    }
}
