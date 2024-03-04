<?php

namespace Tests\Unit\Domain\News\Service;

use App\Domain\News\Repositories\NewsRepositoryInterface;
use App\Domain\News\Services\NewsService;
use App\Models\News;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class NewsServiceTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }

    /**
     * @throws Exception
     */
    public function testGetAllReturnsLengthAwarePaginator()
    {
        $newsRepository = $this->createMock(NewsRepositoryInterface::class);
        $newsService = new NewsService($newsRepository);
        $dataParams = ['page' => 1];

        $this->assertInstanceOf(LengthAwarePaginator::class, $newsService->getAll($dataParams));
    }

    /**
     * @throws Exception
     * @throws \Exception
     */
    public function testGetByIdReturnsNewsWhenFound()
    {
        $newsRepository = $this->createMock(NewsRepositoryInterface::class);
        $newsService = new NewsService($newsRepository);
        $expectedNews = new News();
        $newsRepository->expects($this->once())
            ->method('getById')
            ->willReturn($expectedNews);

        $this->assertEquals($expectedNews, $newsService->getById(1));
    }

    /**
     * @throws Exception
     * @throws \Exception
     */
    public function testGetByIdThrowsModelNotFoundExceptionWhenNotFound()
    {
        $newsRepository = $this->createMock(NewsRepositoryInterface::class);
        $newsService = new NewsService($newsRepository);
        $newsRepository->expects($this->once())
            ->method('getById')
            ->willReturn(null);

        $this->expectException(\Exception::class);
        $newsService->getById(1);
    }
}
