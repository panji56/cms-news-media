<?php

declare(strict_types=1);

namespace Dimsog\Blog\Models;

use System\Models\File;
use Winter\Storm\Database\Model;
use Winter\Storm\Database\Traits\Validation;
use Backend\Facades\BackendAuth;

/**
 * Post Model
 */
class Post extends Model
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


    public function getCategoryIdOptions(): array
    {
        if($this->site_type == 'blog'){
            return Category::where('site_type','blog')->lists('name', 'id');
        }else{
            return Category::where('site_type','news')->lists('name', 'id');
        }
    }

    public function updateViews(): void
    {
        static::where('id', $this->id)
            ->increment('views');
    }

    public static function findActiveBySlug(string $slug): ?static
    {
        return static::where('slug', $slug)
            ->where('active', 1)
            ->first();
    }

    public function maxBlocksPosition(): int
    {
        return $this->blocks->max('position');
    }

    public function getTypeOptions(): array
    {
        return [
            'post' => 'Post',
            'status' => 'Status'
        ];
    }

    public function getSiteTypeOptions(): array
    {
        return [
            'news' => 'News',
            'blog' => 'Blog'
        ];
    }

    public function filterFields($fields)
    {
        switch ($fields->type->value) {
            case 'post':
                $fields->small_text->hidden = false;
                $fields->blocks->hidden = false;
                $fields->image->hidden = false;
                $fields->tags->hidden = false;
                break;
            case 'status':
                $fields->small_text->hidden = true;
                $fields->blocks->hidden = true;
                $fields->image->hidden = true;
                $fields->tags->hidden = true;
                break;
        }
        switch ($fields->site_type->value){
            case 'blog':
                $fields->newsfront->hidden = true;
                break;
            case 'news':
                $fields->newsfront->hidden = false;
                break;
        }

        if( $fields->creator->value == NULL){

            // $fields->creator->placeholder = BackendAuth::getUser()->login;
            // $fields->creator->default = BackendAuth::getUser()->login;
            $fields->creator->readOnly = true;

        }else{

            $fields->creator->disabled = true;

        }

    }

    public function beforeCreate(){
        $this->creator = BackendAuth::getUser()->login;
    }

    public function beforeUpdate()
    {
        if($this->creator == NULL){
            $this->creator = BackendAuth::getUser()->login;
        }
    }

}
