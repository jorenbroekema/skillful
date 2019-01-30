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
}
