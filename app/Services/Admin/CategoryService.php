<?php

namespace App\Services\Admin;

use App\Enums\CategoryStatus;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Log;

class CategoryService
{
    /**
     * Create a new model instance.
     *
     * @param Category $model
     */
    public function __construct(Category $model)
    {   
        $this->model = $model;
    }

    /**
     * Display a listing of post
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function getCategories($request)
    {
        $categories = $this->model->query();
        $limit = config('api.pagination.per_page');

        if ($request->keyword) {
            $categories->where('id', $request->keyword)->orderBy('id', 'desc')->paginate($limit);
        }

        return $categories->orderBy('id', 'desc')->paginate($limit);
    }

    /**
     * Display a listing of category with title, id
     *
     * @return void
     */
    public function listCategory()
    {
        return $this->model->pluck('title', 'id');
    }

    /**
     * Store a newly created resource
     *
     * @param \App\Http\Requests\Admin\Post\AddCategoryRequest $data
     * @return boolean
     */
    public function create($data)
    {
        try {
            $this->model->create([
                'title' => $data->title,
                'description' => $data->description,
                'status' => $data->status,
                'parent_id' => $data->parent_id
            ]);

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }

    /**
     * Update the specified resource
     *
     * @param \App\Http\Requests\Admin\Post\UpdateCategoryRequest $data
     * @param \App\Models\Category $category
     * @return boolean
     */
    public function update($data, $category)
    {
        try {
            $category->update([
                'title' => $data->title,
                'description' => $data->description,
                'status' => $data->status,
                'parent_id' => $data->parent_id
            ]);

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }

    /**
     * Update the specified resource.
     *
     * @param \App\Models\Category $category
     * @return boolean
     */
    public function changeStatus($category)
    {
        try {
            $category['status'] == CategoryStatus::ACTIVE ? $data = ['status' => CategoryStatus::UNACTIVE] : $data = ['status' => CategoryStatus::ACTIVE];
            $category->update($data);

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param \App\Models\Category $category
     * @return boolean
     */
    public function delete($category)
    {
        try {
            $category->delete();

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }
}
