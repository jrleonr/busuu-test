<?php

use Illuminate\Http\Request;


Route::get('/comment/{id}/score', 'CommentController@getTotalScore');
Route::post('/comment/{id}/rate', 'CommentController@postRate');
