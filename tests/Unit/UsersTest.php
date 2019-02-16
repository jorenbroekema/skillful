<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/* phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps */
class UsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_can_own_workshops()
    {
        $user = factory('App\User')->create();
        $this->assertEquals(null, $user->ownedWorkshops()->first());

        $workshop = factory('App\Workshop')->create();
        $workshop->owner_id = $user->id;
        $this->assertEquals($workshop->description, $user->ownedWorkshops()->first()->description);
    }

    /** @test */
    public function users_can_be_workshop_participant()
    {
        $user = factory('App\User')->create();
        $this->assertEquals(null, $user->workshops()->first());

        $workshop = factory('App\Workshop')->create();
        $user->workshops()->save($workshop);
        $this->assertEquals($workshop->description, $user->workshops()->first()->description);

        $multipleWorkshops = factory('App\Workshop', 10)->create();
        $user->workshops()->saveMany($multipleWorkshops);
        $this->assertEquals(11, $user->workshops()->get()->count());
    }

    /*
    public function users_can_be_part_of_group(Type $var = null)
    {
        # code...
    }

    public function users_can_be_group_admin(Type $var = null)
    {
        # code...
    }

    public function users_can_own_skills(Type $var = null)
    {
        # code...
    }

    public function users_can_own_wantToLearns(Type $var = null)
    {
        # code...
    }
    */
}
