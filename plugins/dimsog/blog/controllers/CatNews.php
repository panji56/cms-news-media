<?php namespace Dimsog\Blog\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Backend\Facades\BackendAuth;
use Dimsog\Blog\Models\RelationPost;
use Dimsog\Blog\Models\Category;

/**
 * Posts Back-end Controller
 */
class CatNews extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
         'Backend.Behaviors.FormController',
         'Backend.Behaviors.ListController',
         'Backend.Behaviors.RelationController'
    ];

    /**
     * @var string Configuration file for the `FormController` behavior.
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string Configuration file for the `ListController` behavior.
     */
    public $listConfig = 'config_list.yaml';

    public $relationConfig = 'config_relation.yaml';

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Dimsog.Blog', 'blog', 'cat_news');
    }

    public function create()
    {
        parent::create();
        //BackendMenu::setContext('Dimsog.Blog', 'blog', 'new_post');

    }

    // public function index()    // <=== Action method
    // {
        
    // }


    // public function listExtendQuery($query)
    // {
    //     $query->groupBy('category','order')->orderBy('order','asc')->get();

    // }

}