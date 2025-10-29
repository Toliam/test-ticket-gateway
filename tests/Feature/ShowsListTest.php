<?php

namespace Tests\Feature;

use App\Services\LeadBook\DTO\JsonResponseDTO;
use App\Services\Shows\Repositories\ShowsRepositoryInterface;
use Illuminate\Testing\Fluent\AssertableJson;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ShowsListTest extends TestCase
{
    #[Test]
    public function it_can_be_called_successfully(): void
    {
        // Needle
        $expected = new JsonResponseDTO([
            ['id' => 1, 'name' => 'Test Show #1'],
            ['id' => 2, 'name' => 'Test Show #2'],
            ['id' => 3, 'name' => 'Test Show #3'],
        ]);

        $mock = Mockery::mock(ShowsRepositoryInterface::class, function (MockInterface $mock) use ($expected) {
            $mock->shouldReceive('getShowsList')->once()->andReturn($expected);
        });

        $this->instance(ShowsRepositoryInterface::class, $mock);

        // When
        $response = $this->getJson(route('shows.index'));

        // Then
        $response->assertStatus(200);
        $response->assertJson(static fn (AssertableJson $globalJson) => $globalJson
            ->has('data', null, static fn (AssertableJson $json) => $json
                ->has('id')
                ->has('name')
            )
            ->where('data.0.id', 1)
            ->where('data.0.name', 'Test Show #1')
            ->etc()
        );
    }
}


