<?php

declare(strict_types=1);

namespace Dimsog\Blog\Models;

use Winter\Storm\Database\Model;
use Winter\Storm\Database\Traits\Sluggable;
use Winter\Storm\Database\Traits\Validation;

/**
 * Category Model
 */
class Category extends Model
{
    use Validation;
    use Sluggable;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'dimsog_blog_categories';

    public $slugs = [
        'slug' => 'name'
    ];

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
    public $hasOne = [];
    public $hasMany = [
        'posts' => [Post::class]
    ];
    public $hasOneThrough = [];
    public $hasManyThrough = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];


    public static function findBySlug(?string $slug): ?static
    {
        if (empty($slug)) {
            return null;
        }
        return static::where('slug', $slug)
            ->where('active', 1)
            ->first();
    }

    public function getSiteTypeOptions(): array
    {
        return [
            'news' => 'News',
            'blog' => 'Blog'
        ];
    }
    
    public function beforeCreate(){
        if($this->site_type == 'news'){
            for($idx = 1;$idx <= 3; $idx++){
                $id_cat=rand(1,100000);
                $catnews = new CatNews;
                $catnews->id=($this->slug.$id_cat);
                $catnews->category=$this->name;
                $catnews->order=$idx;
                $catnews->cat_order=$this->position;
                $catnews->save();
            }
        }
    }

    public function beforeUpdate(){
        $cats = CatNews::where('category', $this->name)->first();
        if(!$cats){
            if($this->site_type == 'news'){
                for($idx = 1;$idx <= 3; $idx++){
                    $id_cat=rand(1,100000);
                    $catnews = new CatNews;
                    $catnews->id=($this->slug.$id_cat);
                    $catnews->category=$this->name;
                    $catnews->order=$idx;
                    $catnews->cat_order=$this->position;
                    $catnews->save();
                }
            }
        }else{
            CatNews::where('category', $this->name)->update(['cat_order' => $this->position]);
        }
    }

    public function beforeDelete(){
        $cats = CatNews::where('category', $this->name)->first();
        if($cats){
            CatNews::where('category', $this->name)->delete();
        }
    }

}
