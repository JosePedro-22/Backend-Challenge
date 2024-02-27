<?php

namespace App\Domain\News\Repositories;

use App\Domain\News\Entities\News;

interface NewsRepositoryInterface
{
    public function getAll(): array;

    public function getById(int $id): News;
}
