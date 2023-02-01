<?php

declare(strict_types=1);

namespace App\QueryBuilders;

use Illuminate\Database\Eloquent\Collection;

abstract class QueryBuilder
{
   abstract function getAll(): Collection;
}
