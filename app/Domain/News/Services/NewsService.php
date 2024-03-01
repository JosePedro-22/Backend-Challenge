<?php

namespace App\Domain\News\Services;

use App\Domain\News\Repositories\NewsRepositoryInterface;
use App\Models\News;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class NewsService
{
    protected NewsRepositoryInterface $newsRepository;

    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function getAll(array $dataParams): LengthAwarePaginator
    {
        return $this->newsRepository->getAll($dataParams);
    }

    public function getById(int $id): ?News
    {
        try {
            $new = $this->newsRepository->getById($id);
            if (empty($new)) {
                throw new ModelNotFoundException('Noticia não foi encontrada ...');
            }

            return $new;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new Exception($exception->getMessage());
        }

    }
}
