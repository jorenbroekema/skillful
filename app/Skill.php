<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    /**
     * The attributes that are not mass assignable.
     * By default, skills are not malleable by users.
     *
     * @var array
     */
    protected $fillable = [];

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
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * Relation belongsToMany
     * The skills that are wanted by users
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function isWantedBy()
    {
        return $this->belongsToMany(User::class, 'user_wanted_skill')->withTimestamps();
    }
}
