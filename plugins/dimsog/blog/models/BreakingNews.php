<?php

declare(strict_types=1);

namespace Dimsog\Blog\Models;

use Winter\Storm\Database\Model;
use Winter\Storm\Database\Traits\Validation;
use Illuminate\Support\Facades\Log;

/**
 * Tag Model
 */
class BreakingNews extends Model
{
    use Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'NewsBreaking';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    public $timestamps = false;

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [];

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

    // public function getOrderOptions($value, $formData)
    // {
    //     return ['1' => 1,'2' => 2, '3' => 3];
    // }

    // public function beforeSave(){
    //     $cat_id = Post::where('id',$this->post_id)->first()->category_id;
    //     $cat_name = Category::where('id',$cat_id)->first()->name;
    //     $this->category = $cat_name;
    // }

}
