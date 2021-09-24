<?php

namespace Tests\Unit;

use App\Models\Record;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    public function testGetIndexPageIsOk()
    {
        $response = $this->get('/');
        $response->assertOk();
    }

    public function testGetRecordById()
    {
        $record = Record::create([
            'title' => 'TEST_TITLE',
            'artist' => 'TEST_ARTIST',
            'user_id' => 5
        ]);

        $response = $this->get('/records/'.$record->id);

        $response->assertOk();
        $this->assertEquals('TEST_TITLE', $record->title);
        $this->assertEquals('TEST_ARTIST', $record->artist);
    }
}
