<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    protected $guarded = ['id', 'owner_id', 'created_at', 'updated_at', 'group_id'];

    /**
     * Relation belongsTo
     * The owner that the workshop belongs to
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation belongsTo
     * The group that the workshop belongs to
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Relation belongsToMany
     * The participants of the workshop
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * Whether the workshop shares its group with some other model instance
     * The model instance should either have a group() or groups() property which should be a
     * belongsTo (default) or belongsToMany relationship, defined by the second parameter.
     *
     * @param mixed Some model instance which has a group() or groups() relationship.
     * @param boolean Plural, whether the first argument has one or multiple groups to check for.
     * @return boolean Whether something shares a group with this workshop instance.
     */
    public function sharesGroupWith($something, bool $plural = false)
    {
        return $plural ?
            $something->groups()->get()->contains($this->group()->first()) :
            $something->group()->first() === $this->group()->first();
    }

    // TODO: Has one or more categories / tags (could be JSON or another model)
}
