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
        $workshop->owner()->associate($user)->save();

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

    /** @test */
    public function users_can_own_groups()
    {
        $group = factory('App\Group')->create();
        $user = factory('App\User')->create();
        $group->owner()->associate($user)->save();

        $this->assertEquals($user->id, $group->owner()->first()->id);

        $groups = factory('App\Group', 4)->create();
        $user->ownedGroups()->saveMany($groups);

        $this->assertEquals(5, $user->ownedGroups()->count());
        $this->assertEquals($groups[1]->title, $user->ownedGroups()->get()[2]->title);
    }

    /** @test */
    public function users_can_be_part_of_multiple_groups()
    {
        $groups = factory('App\Group', 2)->create();
        $members = factory('App\User', 3)->create();

        $groups[0]->members()->saveMany([$members[0], $members[1]]);
        $groups[1]->members()->saveMany([$members[1], $members[2]]);

        $this->assertEquals($members[0]->name, $groups[0]->members()->first()->name);
        $this->assertEquals($members[1]->name, $groups[0]->members()->orderBy('id', 'DESC')->first()->name);
        $this->assertEquals($members[1]->name, $groups[1]->members()->first()->name);
    }

    /*
    // Use pivot table here with "privilige level" column
    // Can always change to a JSON column or multiple may_do_X boolean columns
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
