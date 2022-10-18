<?php

namespace App\Services\User;

use App\Models\Post;
use App\Models\Category;
use Carbon\Carbon;

class HomeService
{
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    /**
     * Get the top view Post.
     *
     * @return model
     */
    public function getLastedPost()
    {
        return $this->model->activePost()->postByMonth()->orderByDesc('viewed')->take(1)->get();
    }

    /**
     * Get the top view Post.
     *
     * @return model
     */
    public function getNextPost()
    {
        return $this->model->activePost()->postByMonth()->orderByDesc('viewed')->skip(1)->take(1)->get();
    }

    /**
     * Get the top view Post.
     *
     * @return model
     */
    public function getTwoNextPost()
    {
        return $this->model->activePost()->postByMonth()->orderByDesc('viewed')->skip(2)->take(2)->get();
    }

    /**
     * Get list the new Post.
     *
     * @return model
     */
    public function listNewPost()
    {
        return $this->model->activePost()->orderByDesc('published_at')->take(10)->get();
    }

    /**
     * get listing parent category
     *
     * @return void
     */
    public function getParentCategory()
    {
        return Category::activeCategory()->whereNull('parent_id')->orderBy('order_by')->get();
    }
}
