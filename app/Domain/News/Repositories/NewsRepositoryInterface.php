<?php

namespace App\Domain\News\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

interface NewsRepositoryInterface
{
    public function getAll(array $dataParams): LengthAwarePaginator;

    public function getById(int $id);
}
