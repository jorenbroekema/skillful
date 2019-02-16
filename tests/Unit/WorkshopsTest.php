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
        $user = User::create([
            'name' => 'Joe',
            'email' => 'joe@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
            'remember_token' => str_random(10),
        ]);

        $workshop = Workshop::create([
            'title' => 'Coding workshop',
            'description' => 'Coding for beginners.',
            'difficulty' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'owner_id' => $user->id,
        ]);

        $this->assertEquals('Joe', $workshop->owner()->first()->name);
        $this->assertEquals('joe@gmail.com', $workshop->owner()->first()->email);
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
