<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BugReport extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Relation belongsTo
     * The author that the bug report belongs to
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
