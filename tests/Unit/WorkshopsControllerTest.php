<?php

namespace Tests\Unit;

use App\Http\Controllers\WorkshopsController;

use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/* phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps */
class WorkshopsControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_new_workshop()
    {
        $request = Request::create('/workshops', 'POST', [
            'title' => 'Testing workshop',
            'description' => 'We will be testing our workshops controller here',
            'difficulty' => '1',
            'owner_id' => '5',
        ]);

        $controller = new WorkshopsController();
        $response = $controller->store($request);
        $this->assertEquals(302, $response->getStatusCode());
    }

    /** @test */
    public function can_read_workshops()
    {
        $workshop = factory('App\Workshop')->create();

        $controller = new WorkshopsController();
        $response = $controller->show($workshop);
        $this->assertEquals($workshop->title, $response->workshop->title);
    }

    /** @test */
    public function can_update_workshops()
    {
        $workshop = factory('App\Workshop')->create();

        $request = Request::create('/workshops', 'PATCH', [
            'title' => 'Testing workshop',
            'description' => 'We will be testing our workshops controller\'s update functionality here',
            'difficulty' => '2',
            'owner_id' => '3',
        ]);

        $controller = new WorkshopsController();

        $this->assertFalse(
            'We will be testing our workshops controller\'s update functionality here' === $workshop->description
        );

        $response = $controller->update($request, $workshop);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals(
            'We will be testing our workshops controller\'s update functionality here',
            $workshop->description
        );
    }

    /** @test */
    public function can_delete_workshops()
    {
        $workshop = factory('App\Workshop')->create();

        $controller = new WorkshopsController();
        $response = $controller->destroy($workshop);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertFalse($workshop->exists());
    }

    /** @test */
    public function returns_edit_view()
    {
        $workshop = factory('App\Workshop')->create();

        $controller = new WorkshopsController();
        $response = $controller->edit($workshop);

        $this->assertEquals($workshop, $response->workshop);
    }

    /** @test */
    public function returns_create_view()
    {
        $controller = new WorkshopsController();
        $response = $controller->create();

        $this->assertEquals('object', gettype($response));
    }
}
