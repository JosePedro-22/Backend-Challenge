<?php

namespace Tests\Feature\Domain\News\Service;

use App\Models\News;
use Tests\TestCase;

/**
 * @method format(string $string, mixed $publish_date)
 */
class NewsServiceTest extends TestCase
{
    public function testGetAllReturnsPaginator()
    {
        $response = $this->get('/api/getAll');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data',
        ]);
    }

    public function testGetByIdReturnsNewsDetailsWhenFound()
    {
        $news = News::factory()->create();
        $response = $this->get('/api/getById/' . $news->id);
        $response->assertStatus(200);

        $response->assertJson([
            'data' => [
                'id' => $news->id,
                'title' => $news->title,
                'description'=> $news->description,
                'full_txt'=> $news->full_txt,
                'image'=> $news->image,
                'publish_date' => $news->publish_date->format('Y-m-d'),
            ]
        ]);
    }

    public function testGetByIdReturns404WhenNotFound()
    {
        $response = $this->get('/api/news/3000');
        $response->assertStatus(404);
    }
}
