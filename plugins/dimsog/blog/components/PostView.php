<?php

declare(strict_types=1);

namespace Dimsog\Blog\Components;

use Cms\Classes\ComponentBase;
use Dimsog\Blog\Models\Post;
use Dimsog\Comments\Models\Comment;
use Illuminate\Support\Facades\Log;
use Backend\Facades\BackendAuth;


class PostView extends ComponentBase
{
    private ?Post $post;

    public function countActiveCommentsByUrl(string $url): int
    {
        return Comment::countActiveCommentsByUrl($url);
    }

    public function countActiveCommentsFromCurrentPage(): int
    {
        return $this->countActiveCommentsByUrl($this->getUrl());
    }

    public function count(?string $url = null): int
    {
        if (empty($url)) {
            return $this->countActiveCommentsFromCurrentPage();
        }
        return $this->countActiveCommentsByUrl($url);
    }

    public function getPictureUser(?string $logon)
    {
        $user = BackendAuth::findUserByLogin($logon);
        return $user->getAvatarThumb();
    }

    public function getFirstAndLastName(?string $logon)
    {
        $user = BackendAuth::findUserByLogin($logon);
        return $user->first_name.' '.$user->last_name;
    }

    public function onRun()
    {
        $this->post = Post::findActiveBySlug($this->property('slug'));
        if ($this->post == null) {
            return $this->controller->run('404');
        }
        $this->post->updateViews();
        $this->page->title = $this->post->name;
        $this->page['activeCategory'] = $this->post->category;
    }

    public function onRender(): void
    {
        $this->page['counts'] = $this->count($this->property('slug'));
        $this->page['post'] = $this->post;
    }

    public function componentDetails(): array
    {
        return [
            'name'        => 'dimsog.blog::lang.components.post_view.name',
            'description' => ''
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title' => 'dimsog.blog::lang.components.post_view.slug',
                'description' => '',
                'default' => null,
                'type' => 'string'
            ],
        ];
    }
}
