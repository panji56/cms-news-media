<?php

declare(strict_types=1);

namespace Dimsog\Blog\Models;

use System\Models\File;
use Illuminate\Support\Facades\Log;
use Winter\Storm\Database\Model;
use Winter\Storm\Database\Models\DeferredBinding as DeferredBindingModel;
use Winter\Storm\Database\SortableScope;
use Winter\Storm\Database\Traits\Sortable;
use Winter\Storm\Database\Traits\Validation;
use Illuminate\Support\Str;

/**
 * PostBlock Model
 */
class PostBlock extends Model
{
    use Validation;
    use Sortable;

    const SORT_ORDER = 'position';

    /**
     * @var string The database table used by the model.
     */
    public $table = 'dimsog_blog_post_blocks';

    public $timestamps = false;

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
        'updated_at',
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $hasOneThrough = [];
    public $hasManyThrough = [];
    public $belongsTo = [
        'post' => [Post::class]
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'image' => [File::class, 'delete' => true]
    ];
    public $attachMany = [];


    public static function bootSortable()
    {
        static::created(static function (PostBlock $model): void {
            if (!empty($model->position)) {
                return;
            }
            if (empty($model->post)) {
                $count = 0;
                $binding = new DeferredBindingModel;
                $binding->setConnection($model->getConnectionName());
                $blockIds = $binding
                        ->where('master_type', Post::class)
                        ->where('master_field', 'blocks')
                        ->where('session_key', post('_relation_session_key'))
                        ->pluck('slave_id');

                if (!$blockIds->isEmpty()) {
                    $count = PostBlock::whereIn('id', $blockIds)->max('position');
                }
                static::updatePosition($model->id, $count + 1);
            } else {
                static::updatePosition($model->id, $model->post->maxBlocksPosition() + 1);
            }
        });
        static::addGlobalScope(new SortableScope);
    }

    public static function updatePosition(int $id, int $newPosition): void
    {
        PostBlock::where('id', $id)->update(['position' => $newPosition]);
    }

    public function filterFields($fields)
    {
        $fields->text->hidden = true;
        $fields->code->hidden = true;
        $fields->image->hidden = true;

        switch ($fields->type->value) {
            case 'text':
                $fields->text->hidden = false;
                break;
            case 'code':
                $fields->code->hidden = false;
                break;
            case 'image':
                $fields->image->hidden = false;
                break;
        }
    }

    public function getTypeOptions(): array
    {
        return [
            'text' => 'Text',
            'image' => 'Image',
            'code' => 'Code'
        ];
    }

    function beforeSave(){
        if(!empty($this->text)){
            if($this->type == 'text'){
                $doc = new \DOMDocument();
                $doc->loadhtml($this->text);
                $imgs = $doc->getElementsByTagName('img');
                foreach($imgs as $imgNode){
                    $path = $imgNode->getAttribute("src");
                    if(!ends_with($path,".webp")){
                        $path = Str::afterLast($path,"/media/");
                        $path = media_path($path);
                        if(Str::startsWith($path,"\\")){
                            $path = Str::after($path,"\\");
                        }else{
                            $path = Str::after($path,"/");
                        };
                        if(file_exists($path) && ends_with($path,".webp")){
                            $outputPath = str_replace(".jpg",".webp",$path);
                        }else{
                            $info = getimagesize($path);
                            $isAlpha = false;
                            $outputPath = "";
                            switch ($info['mime']) {
                                case 'image/jpeg':
                                    $image = imagecreatefromjpeg($path);
                                    $outputPath = str_replace(".jpg",".webp",$path);
                                    break;
                                case 'image/gif':
                                    $isAlpha = true;
                                    $image = imagecreatefromgif($path);
                                    $outputPath = str_replace(".gif",".webp",$path);
                                    break;
                                case 'image/png':
                                    $isAlpha = true;
                                    $image = imagecreatefrompng($path);
                                    $outputPath = str_replace(".png",".webp",$path);
                                    break;
                                }
                            if ($isAlpha) {
                                    imagepalettetotruecolor($image);
                                    imagealphablending($image, true);
                                    imagesavealpha($image, true);
                                }
                            imagewebp($image, $outputPath, 70);
                            unlink($path);
                        }
                        clearstatcache();
                        if(Str::startsWith($outputPath,"storage\\")){
                            $outputPath = Str::replace('\\','/','\\'.$outputPath);
                        }else{
                            $outputPath = '/'.$outputPath;
                        }
                        $imgNode->setAttribute("src",$outputPath);
                    }
                }
                $doc = $doc->saveHTML();
                $this->text = $doc;
            }
        }
    }

    // function afterFetch(){
    //     if($this->type == 'text'){
    //         $doc = new \DOMDocument();
    //         $doc->loadhtml($this->text);
    //         $imgs = $doc->getElementsByTagName('img');
    //         foreach($imgs as $imgNode){
    //             $imgNode->setAttribute("height","350");
    //         }
    //         $doc = $doc->saveHTML();
    //         Log::info($doc);
    //     }
    // }

}
