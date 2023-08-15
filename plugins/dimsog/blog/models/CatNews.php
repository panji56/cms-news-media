<?php

declare(strict_types=1);

namespace Dimsog\Blog\Models;

use Winter\Storm\Database\Model;
use Winter\Storm\Database\Traits\Validation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Validator;

/**
 * Tag Model
 */
class CatNews extends Model
{
    use Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'CatNews_Table';

    /**
     * @var array Guarded fields
     */
    protected $guarded = [];

    public $incrementing = false;

    public $timestamps = false;

    protected $primaryKey = 'id';

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['cat_order'];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [
        'post_id' => 'post_val:'
    ];

    public $customMessages = [
        'post_id'    => 'The Post Does not Match with the category'
    ];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = [];

    /**
     * @var array Attributes to be appended to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array Attributes to be removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $hasOneThrough = [];
    public $hasManyThrough = [];
    public $belongsTo = [
        'post' => [Post::class,'default' => true],
        'relationpost' => [RelationPost::class,'default' => true,'key' => 'post_id']
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    protected static function booted()
    {
        Validator::extend('post_val',function($attribute, $value, $parameters){
            $post_cat = Post::join('dimsog_blog_categories','category_id','=','dimsog_blog_categories.id')->where('dimsog_blog_posts.id',$value)->first();
            $url = Request::url();
            // $url = explode("/",$url);
            // $url = last($url);
            $url = Str::afterlast($url,'/');
            $cat = CatNews::find($url);
            Log::info($url);
            if(strcmp($cat->category,$post_cat->name) == 0){
                return true;
            }else{
                return false;
            }
        });
    }

}
