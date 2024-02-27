<?php

namespace App\Domain\News\Services;

use App\Domain\News\Entities\News;
use App\Domain\News\Repositories\NewsRepositoryInterface;

class NewsService
{
    protected NewsRepositoryInterface $newsRepository;

    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function getAll(): array
    {
        return $this->newsRepository->getAll();
    }

    public function getById(int $id): News
    {
        return $this->newsRepository->getById($id);
    }
}
