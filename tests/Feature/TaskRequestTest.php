<?php

namespace Tests\Feature;

use App\Rules\ProhibitedWords;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class TaskRequestTest extends TestCase
{
    public function test_description_rejects_blocked_words(): void
    {
        $validator = Validator::make(
            ['description' => 'Este texto tiene spam'],
            ['description' => [new ProhibitedWords()]],
        );

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('description', $validator->errors()->toArray());
    }
}
