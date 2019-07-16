<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'owner_id', 'created_at', 'updated_at'];

    /**
     * Relation belongsTo
     * The owner that the group belongs to
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation belongsToMany
     * The members of this group
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function workshops()
    {
        return $this->hasMany(Workshop::class);
    }
}
