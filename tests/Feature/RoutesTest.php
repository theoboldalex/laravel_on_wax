<?php

namespace Tests\Feature;

use App\Models\Record;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    use DatabaseTransactions;

    protected Collection|Model|Authenticatable $user;
    protected string $password;

    protected function setUp(): void
    {
        parent::setUp();

        Session::start();
        $this->user = User::factory()->create([
            'password' => Hash::make($this->password = 'test1234')
        ]);
    }

    public function testGetIndexPageIsOk()
    {
        $response = $this->get('/');
        $response->assertOk();
    }

    public function testGetRecordById()
    {
        $record = Record::factory()->for($this->user)->create();

        $response = $this->get("/records/{$record->id}");

        $response->assertOk();
        $this->assertEquals('TEST_TITLE', $record->title);
        $this->assertEquals('TEST_ARTIST', $record->artist);
    }

    public function testGetUsersRecords()
    {
        $userRecords = Record::factory()->count(5)->for($this->user)->create();

        $response = $this->get("/users/{$this->user->username}");
        $response->assertOk();

        $this->assertEquals(5, $userRecords->count());

        $view = $this->view('users.profile', ['user' => $this->user]);
        $view->assertSee($this->user->username);

        foreach ($userRecords as $record) {
            $this->assertEquals($record->user_id, $this->user->id);
            $view->assertSee($record->id);
        }
    }

    public function testUserCanLogin()
    {
        $credentials = [
            'email' => $this->user->email,
            'password' => $this->password,
            '_token' => csrf_token()
        ];

        $response = $this->call(
            'POST',
            '/auth/login',
            $credentials
        );

        $response->assertRedirect('/');
        $response->assertSessionHasNoErrors();
        $response->assertSessionMissing(['status' => 'Invalid credentials']);
        $this->assertAuthenticatedAs($this->user);
    }
}
