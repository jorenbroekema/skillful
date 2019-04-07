<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Relation belongsTo
     * The skills that belong to this category
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function skillsCategory()
    {
        return $this->belongsTo(SkillsCategory::class);
    }

    /**
     * Relation belongsToMany
     * The skills that are owned by users
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function isOwnedBy()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Relation belongsToMany
     * The skills that are wanted by users
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function isWantedBy()
    {
        return $this->belongsToMany(User::class);
    }
}
