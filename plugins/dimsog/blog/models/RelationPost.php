<?php

declare(strict_types=1);

namespace Dimsog\Blog\Models;

use System\Models\File;
use Winter\Storm\Database\Model;
use Winter\Storm\Database\Builder;
use Winter\Storm\Database\Traits\Validation;
use Backend\Facades\BackendAuth;

/**
 * Post Model
 */
class RelationPost extends Model
{
    use Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'dimsog_blog_posts';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

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
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [
        'newsfront' => [NewsFront::class]
    ];
    public $hasMany = [
        'tags' => [PostTag::class],
        'blocks' => [PostBlock::class]
    ];
    public $hasOneThrough = [];
    public $hasManyThrough = [];
    public $belongsTo = [
        'category' => Category::class
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'image' => [File::class, 'delete' => true]
    ];
    public $attachMany = [];

    // protected static function booted()
    // {
    //     static::addGlobalScope('filteredSearch', function (Builder $builder) {
    //         $builder->whereNotIn('id',CatNews::select('post_id')->get());
    //     });
    // }

    public function scopeBreaking($query,$model){
        $nullcount = BreakingNews::select('post_id')->whereNotNull('post_id')->count();
            if($nullcount > 0){
                return $query->whereNotIn('id',BreakingNews::select('post_id')->whereNotNull('post_id')->get())->where('site_type','like','news');
            }
    }

    public function scopeFeatured($query,$model){
        $nullcount = FeaturedNews::select('post_id')->whereNotNull('post_id')->count();
            if($nullcount > 0){
                return $query->whereNotIn('id',FeaturedNews::select('post_id')->whereNotNull('post_id')->get())->where('site_type','like','news');
            }
    }

    public function scopeFyp($query,$model){
        $nullcount = NewsFront::select('post_id')->whereNotNull('post_id')->count();
            if($nullcount > 0){
                return $query->whereNotIn('id',NewsFront::select('post_id')->whereNotNull('post_id')->get())->where('site_type','like','news');
            }
    }

    public function scopeTrending($query,$model){
        $nullcount = TrendingNews::select('post_id')->whereNotNull('post_id')->count();
            if($nullcount > 0){
                return $query->whereNotIn('id',TrendingNews::select('post_id')->whereNotNull('post_id')->get())->where('site_type','like','news');
            }
    }

    public function scopeCat($query,$model){
        $nullcount = CatNews::select('post_id')->whereNotNull('post_id')->count();
            if($nullcount > 0){
                return $query->whereNotIn('id',CatNews::select('post_id')->whereNotNull('post_id')->get())->where('site_type','like','news');
            }
    }

}
