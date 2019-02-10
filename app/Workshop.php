<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    /**
     * Relationships:
     * Has one author / owner (User hasOne)
     * Has multiple attendees (User hasMany)
     * Has one or more categories / tags (could be JSON or another model)
     */

    protected $guarded = [''];

    /**
     * Relation belongsTo
     * The owner that the workshop belongs to
     *
     * @return App\User
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
