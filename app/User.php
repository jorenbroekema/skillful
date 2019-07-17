<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
        return $this->hasMany(Skill::class)->withTimestamps();
    }

    /**
     * Relation hasMany
     * The skills that are wanted by the user
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wantedSkills()
    {
        return $this->hasMany(Skill::class)->withTimestamps();
    }
}
