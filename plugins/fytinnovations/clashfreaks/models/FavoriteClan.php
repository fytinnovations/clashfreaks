<?php namespace Fytinnovations\ClashFreaks\Models;

use Model;

/**
 * Favorite Model
 */
class FavoriteClan extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'fytinnovations_clashfreaks_favorite_clans';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['user_id','clan_tag'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'users'=>'Rainlab\User\Models\User'
    ];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}
