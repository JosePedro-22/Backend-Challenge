<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\News\Repositories\NewsRepositoryInterface;
use App\Models\News;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class EloquentNewsRepository implements NewsRepositoryInterface
{
    protected News $newsModel;

    public function __construct(News $newsModel)
    {
        $this->newsModel = $newsModel;
    }

    public function getAll(array $dataParams): LengthAwarePaginator
    {
        $serializetion = serialize($dataParams);

        if (Cache::has('listNews'.$serializetion)) {
            return Cache::get('listNews'.$serializetion);
        }

        return Cache::rememberForever('listNews'.$serializetion, function () use ($dataParams) {
            return $this->newsModel->query()
                ->paginate(perPage: $dataParams['per_page'] ?? 12, page: $dataParams['page'] ?? 1);
        });
    }

    public function getById(int $id)
    {
        return $this->newsModel->query()->find($id);
    }
}
