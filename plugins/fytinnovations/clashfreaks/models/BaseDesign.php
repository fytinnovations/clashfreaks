<?php namespace Fytinnovations\ClashFreaks\Models;

use Model;

/**
 * BaseDesign Model
 */
class BaseDesign extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'fytinnovations_clashfreaks_base_designs';

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
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}
