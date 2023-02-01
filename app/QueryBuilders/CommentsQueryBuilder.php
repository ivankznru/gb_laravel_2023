<?php

declare(strict_types=1);

namespace App\QueryBuilders;

use App\Models\Comments;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

final class CommentsQueryBuilder extends QueryBuilder
{
    public Builder $model;

    public function __construct()
    {
        $this->model = Comments::query();
    }

    public function getCommentsWithPagination(int $quantity = 10): LengthAwarePaginator
    {
        return $this->model->paginate($quantity);
    }

    public function getAll(): Collection
    {
        return $this->model->get();
    }
}
