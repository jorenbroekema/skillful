<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkillsCategory extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Relation hasMany
     * The skills that belong to this category
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
}
