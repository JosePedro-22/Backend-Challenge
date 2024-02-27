<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\News\Entities\News;
use App\Domain\News\Repositories\NewsRepositoryInterface;

class EloquentNewsRepository implements NewsRepositoryInterface
{
    protected News $newsModel;

    public function __construct(News $newsModel)
    {
        $this->newsModel = $newsModel;
    }

    public function getAll(): array
    {
        return $this->newsModel->paginate(10);

    }

    public function getById(int $id): News
    {
        return $this->newsModel->findOrFail($id);
    }
}
