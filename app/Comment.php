<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text', 'user_id', 'score'
    ];

    /**
     * Get the User that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The ratings that belong to the comment.
     */
    public function ratings()
    {
        return $this->hasMany('App\Rating');
    }
}
