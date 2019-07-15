<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkillsCategory extends Model
{
    /**
     * The attributes that are not mass assignable.
     * By default, skill categories are not malleable by users.
     *
     * @var array
     */
    protected $fillable = [];

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
