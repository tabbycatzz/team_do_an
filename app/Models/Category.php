<?php

namespace App\Models;

use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\CategoryStatus;

class Category extends Model
{
    use HasFactory, 
        SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'status',
        'order_by',
        'parent_id'
    ];

    protected $table = 'categories';

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class , 'parent_id');
    }

    public function post()
    {
        return $this->hasMany(Post::class, 'category_id');
    }

    public function getPostDashboard()
    {
        return $this->hasMany(Post::class, 'category_id')
            ->where('status', '=', PostStatus::ACTIVE)
            ->orderByDesc('created_at')
            ->take(4);
    }

    public function scopeActiveCategory($category)
    {
        return $category->where('status', '=', CategoryStatus::ACTIVE);
    }
}
