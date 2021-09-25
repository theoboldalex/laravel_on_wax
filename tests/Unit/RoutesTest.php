<?php

namespace Tests\Unit;

use App\Models\Record;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    use DatabaseTransactions;

    public function testGetIndexPageIsOk()
    {
        $response = $this->get('/');
        $response->assertOk();
    }

    public function testGetRecordById()
    {
        $user = User::factory()->create();
        $record = Record::factory()->for($user)->create();

        $response = $this->get("/records/{$record->id}");

        $response->assertOk();
        $this->assertEquals('TEST_TITLE', $record->title);
        $this->assertEquals('TEST_ARTIST', $record->artist);
    }
}
