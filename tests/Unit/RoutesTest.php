<?php

namespace Tests\Unit;

use Tests\TestCase;

class RoutesTest extends TestCase
{
    public function testGetIndexPageIsOk()
    {
        $response = $this->get('/');
        $response->assertOk();
    }
}
