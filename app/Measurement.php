<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'weight', 'bodyfat', 'tbw', 'muscle', 'bone'];

    /**
     * Get the user that owns the measurement.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
