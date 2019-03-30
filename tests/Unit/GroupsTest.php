<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/* phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps */
class GroupsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function group_has_an_owner()
    {
        // Group cannot be created without at least 1 user to be owner
        $user = factory('App\User')->create();
        $group = factory('App\Group')->create();

        $this->assertEquals(null, $group->owner()->first());
    }

    /** @test */
    public function group_can_have_multiple_members()
    {
        $members = factory('App\User', 3)->create();
        $secondUserName = $members[1]->name;
        $group = factory('App\Group')->create();

        $this->assertEquals(null, $group->members()->first());
        $group->members()->saveMany($members);
        $this->assertEquals(3, $group->members()->get()->count());
        $this->assertEquals($secondUserName, $group->members()->get()[1]->name);
    }
}
