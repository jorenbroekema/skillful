<?php

namespace Tests\Unit;

use App\User;
use App\Workshop;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/* phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps */
class WorkshopsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function workshops_have_an_owner()
    {
        $user = factory('App\User')->create();
        $workshop = factory('App\Workshop')->create();

        $this->assertEquals(null, $workshop->owner()->first());

        $workshop->owner()->associate($user);

        $this->assertEquals($user->name, $workshop->owner()->first()->name);
        $this->assertEquals($user->email, $workshop->owner()->first()->email);
    }

    /** @test */
    public function workshops_can_have_participants()
    {
        $owner = factory('App\User')->create();
        $participants = factory('App\User', 3)->create();
        $secondParticipantName = $participants[1]->name;
        $workshop = factory('App\Workshop')->create();

        $this->assertEquals(null, $workshop->users()->first());
        $workshop->users()->saveMany($participants);
        $this->assertEquals(3, $workshop->users()->get()->count());
        $this->assertEquals($secondParticipantName, $workshop->users()->get()[1]->name);
    }
}
