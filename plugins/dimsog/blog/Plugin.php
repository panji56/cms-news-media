<?php

declare(strict_types=1);

namespace Dimsog\Blog;

use Backend;
use Cms\Classes\Page;
use Backend\Models\UserRole;
use Dimsog\Blog\Components\CategoriesList;
use Dimsog\Blog\Components\PostsList;
use Dimsog\Blog\Components\PostView;
use Dimsog\Blog\Components\TagView;
use Dimsog\Blog\Components\NewsFrontList;
use Dimsog\Blog\Components\CatView;
use Dimsog\Blog\Components\BreakingNewsComponent;
use Dimsog\Blog\Components\TrendingNewsComponent;
use Dimsog\Blog\Components\FeaturedNewsComponent;
use Dimsog\Blog\Models\Settings;
use System\Classes\PluginBase;

/**
 * Blog Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails(): array
    {
        return [
            'name'        => 'dimsog.blog::lang.plugin.name',
            'description' => 'dimsog.blog::lang.plugin.description',
            'author'      => 'Dimsog',
            'icon'        => 'icon-th-list'
        ];
    }

    public function boot(): void
    {
        Page::extend(static function (Page $page): void {
            /** @var Settings $settings */
            $settings = Settings::instance();

            $page['blog_meta_title'] = $settings->getMainPageMetaTitle();
            $page['blog_meta_description'] = $settings->getMainPageMetaDescription();
            $page['blog_name'] = $settings->getBlogName();
            $page['blog_description'] = $settings->getBlogDescription();
            $page['blog_poster'] = $settings->getBlogPoster();
            $page['blog_main_page_meta_title'] = $settings->getMainPageMetaTitle();
            $page['blog_name_color'] = $settings->getBlogNameColor();
            $page['blog_description_color'] = $settings->getDescriptionColor();
            $page['blog_menu_color'] = $settings->getMenuColor();
            $page['blog_menu_color_hover'] = $settings->getMenuColorHover();
            $page['blog_menu_color_active'] = $settings->getMenuColorActive();
        });
    }

    public function registerComponents(): array
    {
        return [
            CategoriesList::class => 'categoriesList',
            PostsList::class => 'postsList',
            PostView::class => 'postView',
            TagView::class => 'tagView',
            NewsFrontList::class => 'newsFrontList',
            CatView::class => 'catView',
            TrendingNewsComponent::class => 'trending_news',
            FeaturedNewsComponent::class => 'featured_news',
            BreakingNewsComponent::class => 'breaking_news'
        ];
    }

    public function registerPermissions()
    {
        return [
            'dimsog.settings.access_posts' => [
                'tab'   => 'dimsog.blog::lang.settings.name',
                'label' => 'dimsog.blog::lang.settings.name',
                'roles' => [UserRole::CODE_DEVELOPER, UserRole::CODE_PUBLISHER],
            ]
        ];
    }

    public function registerSettings(): array
    {
        return [
            'comments' => [
                'label' => 'dimsog.blog::lang.settings.name',
                'description' => '',
                'category' => 'dimsog.blog::lang.settings.name',
                'icon' => 'icon-file-text-o',
                'class' => Settings::class,
                'order' => 500,
                'keywords' => 'blog',
                'permissions' => []
            ]
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation(): array
    {
        return [
            'blog' => [
                'label'       => 'dimsog.blog::lang.plugin.navigation.blog',
                'url'         => Backend::url('dimsog/blog/posts'),
                'icon'        => 'icon-file-text-o',
                'permissions' => ['dimsog.settings.access_posts'],
                'order'       => 500,
                'sideMenu' => [
                    'new_post' => [
                        'label'       => 'dimsog.blog::lang.plugin.navigation.new_post',
                        'url'         => Backend::url('dimsog/blog/posts/create'),
                        'icon'        => ' icon-plus',
                        'permissions' => ['dimsog.settings.access_posts'],
                        'order'       => 500
                    ],
                    'posts' => [
                        'label'       => 'dimsog.blog::lang.plugin.navigation.posts',
                        'url'         => Backend::url('dimsog/blog/posts'),
                        'icon'        => 'icon-file-text-o',
                        'permissions' => ['dimsog.settings.access_posts'],
                        'order'       => 500
                    ],
                    'add_to_fyp' => [
                        'label'       => 'Add to FYP',
                        'url'         => Backend::url('dimsog/blog/fyp'),
                        'icon'        => 'icon-file-text-o',
                        'permissions' => ['dimsog.settings.access_posts'],
                        'order'       => 500
                    ],
                    'featured_news' => [
                        'label'       => 'Add to Featured News',
                        'url'         => Backend::url('dimsog/blog/featurednews'),
                        'icon'        => 'icon-file-text-o',
                        'permissions' => ['dimsog.settings.access_posts'],
                        'order'       => 500
                    ],
                    'breaking_news' => [
                        'label'       => 'Add to Breaking News',
                        'url'         => Backend::url('dimsog/blog/breakingnews'),
                        'icon'        => 'icon-file-text-o',
                        'permissions' => ['dimsog.settings.access_posts'],
                        'order'       => 500
                    ],
                    'trending_news' => [
                        'label'       => 'Add to Trending News',
                        'url'         => Backend::url('dimsog/blog/trendingnews'),
                        'icon'        => 'icon-file-text-o',
                        'permissions' => ['dimsog.settings.access_posts'],
                        'order'       => 500
                    ],
                    'categories' => [
                        'label'       => 'dimsog.blog::lang.plugin.navigation.categories',
                        'url'         => Backend::url('dimsog/blog/categories'),
                        'icon'        => 'icon-list-ul',
                        'permissions' => ['dimsog.settings.access_posts'],
                        'order'       => 500
                    ],
                    'cat_news' => [
                        'label'       => 'Add to Categorized News',
                        'url'         => Backend::url('dimsog/blog/catnews'),
                        'icon'        => 'icon-list-ul',
                        'permissions' => ['dimsog.settings.access_posts'],
                        'order'       => 500
                    ],
                    'tags' => [
                        'label'       => 'dimsog.blog::lang.plugin.navigation.tags',
                        'url'         => Backend::url('dimsog/blog/tags'),
                        'icon'        => 'icon-link',
                        'permissions' => ['dimsog.settings.access_posts'],
                        'order'       => 500
                    ]
                ]
            ]
        ];
    }
}
