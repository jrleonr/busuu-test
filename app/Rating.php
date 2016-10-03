<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rate', 'user_id', 'comment_id',
    ];

    /**
     * The user that belong to the rating.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The comment that belong to the rating.
     */
    public function comment()
    {
        return $this->belongsTo('App\Comment');
    }


}
