<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MatchesTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->matches = factory('App\Matches')->create();
    }

    /** @test */
    public function recent_matches_loads()
    {
        $response = $this->get('/matches');
        $response->assertSee('Recent Matches');
    }
}
