<?php

declare(strict_types=1);

namespace Dimsog\Blog\Classes;

use Dimsog\Blog\Models\Post;
use Dimsog\Blog\Models\PostTag;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PostsReader
{

    //private Collection $pg;

    private int $limit;

    private int $categoryId = 0;

    private int $tagId = 0;

    private int $page = 1;

    private int $count = 0;

    private String $site_type;

    public function __construct(int $limit = 20,int $page = 1)
    {
        $this->limit = $limit;
        $this->page = $page;
    }

    public function setCategoryId(int $categoryId): self
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    public function setTagId(int $tagId): self
    {
        $this->tagId = $tagId;
        return $this;
    }

    public function setSiteType(String $site_type): self
    {
        $this->site_type = $site_type;
        return $this;
    }

    public function read(): LengthAwarePaginator
    {
        $query = Post::where('active', 1);
        if ($this->categoryId > 0) {
            $query->where('category_id', $this->categoryId);
        }
        if ($this->tagId > 0) {
            // $query->join('dimsog_blog_post_tags', 'post_id', '=', 'dimsog_blog_posts.id');
            // $query->where('tag_id', $this->tagId);
            $this->pg = PostTag::where('tag_id','=',$this->tagId)->lists('post_id');
            $query->whereIn('id', $this->pg);
        }
        $query->where('site_type', $this->site_type);
        $query->orderByDesc('dimsog_blog_posts.created_at');
        return $query->paginate($this->limit,$this->page);
    }
}
