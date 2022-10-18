<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\PostService;
use App\Http\Requests\User\PostRequest;
use Illuminate\Support\Facades\Event;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->postService->getCategories();

        return view('user.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\User\PostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest  $request)
    {
        if ($this->postService->create($request)) {
            return redirect()->back()->with('success', __('messages.post.create_success'));
        }

        return redirect()->back()->with('error', __('messages.post.create_fail'));
    }

    /**
     * Display detail for post
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function show(Post $post)
    {
        $countComment = count($this->postService->getComments($post));
        $countPosts = count($this->postService->getPosts($post));
        $postUser = $this->postService->getPostUser($post);
        $postCategory = $this->postService->getPostCategory($post);
        $users = $this->postService->getUsers();
        Event::dispatch('posts.view', $post);

        return view('user.posts.detail', compact('post', 'countComment', 'countPosts', 'postUser', 'postCategory', 'users'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $postLatest = $this->postService->getPostLatest($category->id);
        $postsOlder = $this->postService->getPostsOlder($category->id);
        $posts = $this->postService->getPost($category->id);
        $postsView = $this->postService->getPostView($category->id);
        
        return view('user.posts.index', compact('category', 'postLatest', 'postsOlder', 'posts', 'postsView'));
    }

    /**
     * Display a listing children category.
     *
     * @return \Illuminate\Http\Response
     */
    public function findCategoryChildren(Request $request)
    {
        $categoryChildren = $this->postService->getChildrenCategories($request);

        return response()->json($categoryChildren);
    }

    /**
     * Show list of searched articles
     *
     * @param \Illuminate\Http\Request; $request
     */
    public function search(Request $request)
    {
        $posts = $this->postService->searchPost($request);

        return view('user.posts.search', compact('posts'));
    }

    /**
     * Upload image
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request){
        if ($this->postService->upload($request)) {
            return redirect()->back()->with('success', __('messages.post.upload_image_success'));
        }

        return redirect()->back()->with('error', __('messages.post.upload_image_fail'));
    }
}
