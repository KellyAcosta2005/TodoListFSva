<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_tasks_index_page_loads(): void
    {
        $response = $this->get('/tasks');

        $response->assertOk();
    }

    public function test_tasks_create_page_loads(): void
    {
        $response = $this->get('/tasks/create');

        $response->assertOk();
    }
}
