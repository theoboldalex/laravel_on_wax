<?php

namespace Tests\Feature;

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

    public function testGetUsersRecords()
    {
        $user = User::factory()->create();
        $userRecords = Record::factory()->count(5)->for($user)->create();

        $response = $this->get("/users/{$user->username}");
        $response->assertOk();

        $this->assertEquals(5, $userRecords->count());

        $view = $this->view('users.profile', ['user' => $user]);
        $view->assertSee($user->username);

        foreach ($userRecords as $record) {
            $this->assertEquals($record->user_id, $user->id);
            $view->assertSee($record->id);
        }
    }
}
