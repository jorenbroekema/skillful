<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'feedback'];

    /**
     * Relation belongsTo
     * The author that the feedback belongs to
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
