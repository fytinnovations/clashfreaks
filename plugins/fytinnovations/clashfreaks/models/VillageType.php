<?php namespace Fytinnovations\ClashFreaks\Models;

use Model;

/**
 * VillageType Model
 */
class VillageType extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'fytinnovations_clashfreaks_village_types';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'townhalls' => "Fytinnovations\ClashFreaks\Models\TownHall"
    ];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}
