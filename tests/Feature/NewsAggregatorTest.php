<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsAggregatorTest extends TestCase
{
    /**
     * Test #1
     *
     * @return void
     */
    public function test_the_application_main_page_returns_a_successful_response()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSeeText('Wellcome');
    }
    /**
     * Test #2
     *
     * @return void
     */
    public function test_the_categories_page_contains_a_default_category()
    {
        $response = $this->get(route('news.index'));
        $response->assertStatus(200);
        $response->assertSeeText('Sport');
    }
    /**
     * Test #3
     *
     * @return void
     */
    public function test_the_sport_category_page_contains_a_default_news_item()
    {
        $response = $this->get(route('news.category', 'sport'));
        $response->assertStatus(200);
        $response->assertSeeText('Something about Sport #9');
    }
    /**
     * Test #4
     *
     * @return void
     */
    public function test_the_detail_news_page_contains_a_default_news_item_text()
    {
        $response = $this->get(route('news.detail', 'something-about-travel-13'));
        $response->assertStatus(200);
        $response->assertSeeText('Here is a text #13 about Travel');
    }
    /**
     * Test #5
     *
     * @return void
     */
    public function test_the_add_news_item_page_contains_a_form_that_posts_to_itself()
    {
        $response = $this->get(route('admin.news.create'));
        $response->assertStatus(200);
        $response->assertSee('<form action="' . route('admin.news.create') . '"', false);
    }
}
