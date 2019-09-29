<?php namespace Fytinnovations\ClashFreaks\Models;

use Model;

/**
 * FavoritePlayer Model
 */
class FavoritePlayer extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'fytinnovations_clashfreaks_favorite_players';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['player_tag','user_id'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'users'=>'Rainlab\User\Models\User'
    ];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}
