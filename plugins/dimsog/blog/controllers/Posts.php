<?php namespace Dimsog\Blog\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Backend\Facades\BackendAuth;
use Backend\Models\UserGroup;
use Backend\Models\User;
use Illuminate\Support\Facades\Log;
use Winter\Storm\Support\Facades\DB;

/**
 * Posts Back-end Controller
 */
class Posts extends Controller
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

        BackendMenu::setContext('Dimsog.Blog', 'blog', 'posts');
    }

    public function create()
    {
        parent::create();
        BackendMenu::setContext('Dimsog.Blog', 'blog', 'new_post');
    }

    public function listExtendQuery($query)
    {
        $user_id_in_group = DB::table('backend_users_groups')->whereIn('user_group_id',$this->user->groups()->lists('id'))->lists('user_id');
        $user_in_group = User::whereIn('id',$user_id_in_group)->lists('login');
        $query->whereIn('creator',$user_in_group)->get();
    }
}
