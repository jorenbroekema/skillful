<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DateTime;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'timezone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * isSuperAdmin to check if the user is the super admin
     *
     * @return Boolean whether the current user is super admin
     */
    public function isSuperUser()
    {
        if ($this->name === env('APP_ADMIN_USER')) {
            return true;
        }
        return false;
    }

    /**
     * Function to check if user owns an instance of a model
     *
     * @return Boolean whether model instance is owned by the user.
     */
    public function owns($model, $column_name = 'owner_id')
    {
        return $this->id === $model->$column_name;
    }

    /**
     * Relation hasMany
     * The workshops that are owned by the users
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ownedWorkshops()
    {
        return $this->hasMany(Workshop::class, 'owner_id');
    }

    /**
     * upcomingWorkshops
     * Take all workshops the user participates in, or owns
     * Filter out workshops that have a start_date that is in the past
     * Order by first upcoming start_date
     *
     * @return Collection|App\Workshop[]
     */
    public function upcomingWorkshops()
    {
        $participatingWorkshops = $this->workshops()->get();
        $ownedWorkshops = $this->ownedWorkshops()->get();

        $workshops = $participatingWorkshops->concat($ownedWorkshops)->filter(function ($value, $key) {
            $workshopStart = new DateTime($value->start_date);
            $now = new DateTime();
            return $workshopStart > $now;
        });

        return $workshops->sortBy('start_date');
    }

    /**
     * Relation belongsToMany
     * The workshops that the user is participating in
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function workshops()
    {
        return $this->belongsToMany(Workshop::class)->withTimestamps();
    }

    /**
     * Relation hasMany
     * The workshops that are owned by the user
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ownedGroups()
    {
        return $this->hasMany(Group::class, 'owner_id');
    }

    /**
     * Relation belongsToMany
     * The groups that the user is a member of
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class)->withTimestamps();
    }

    /**
     * Relation hasMany
     * The skills that are owned by the user
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    /**
     * Relation hasMany
     * The skills that are wanted by the user
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wantedSkills()
    {
        return $this->belongsToMany(Skill::class, 'user_wanted_skill');
    }
}
