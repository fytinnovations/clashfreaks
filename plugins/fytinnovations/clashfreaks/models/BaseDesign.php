<?php namespace Fytinnovations\ClashFreaks\Models;

use Model;
use App;
use BackendAuth;
use Rainlab\User\Models\User;
use Auth;
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
    public $belongsTo = [
        'town_hall'=>"Fytinnovations\ClashFreaks\Models\TownHall"
    ];
    public $belongsToMany = [];
    public $morphTo = [
        'created_by'=>[],
        'updated_by'=>[]
    ];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [
        'images'=>'System\Models\File'
    ];

    public function afterCreate(){
        if(App::runningInBackend()){
            $user = BackendAuth::getUser();
        }else if(App::runningInConsole()){
            $user= User::find(20);
        }
        else{
            $user = Auth::getUser();
        }

        //After creation of the base attach it to the logged in user.
        $user->basedesigns_created()->add($this);
        $user->basedesigns_updated()->add($this);
    }

    public function beforeUpdate(){
        if(App::runningInBackend()){
            $user = BackendAuth::getUser();
        }else{
            $user = Auth::getUser();
        }
        //After updation of the base touch the updated_by.
        $this->updated_by=$user;
    }
}
