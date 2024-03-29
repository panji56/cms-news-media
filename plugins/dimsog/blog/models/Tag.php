<?php

declare(strict_types=1);

namespace Dimsog\Blog\Models;

use Winter\Storm\Database\Model;
use Winter\Storm\Database\Traits\Sluggable;
use Winter\Storm\Database\Traits\Validation;

/**
 * Tag Model
 */
class Tag extends Model
{
    use Validation;
    use Sluggable;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'dimsog_blog_tags';

    public $slugs = [
        'slug' => 'name'
    ];

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
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
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
        return static::where('slug', $slug)->first();
    }

    public function getSiteTypeOptions(): array
    {
        return [
            'news' => 'News',
            'blog' => 'Blog'
        ];
    }

}
