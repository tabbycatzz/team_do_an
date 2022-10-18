<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CommentRequest;
use App\Models\Comment;
use App\Services\User\CommentService;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Save user comments
     *
     * @param \App\Http\Requests\User\CommentRequest $request
     * @return void
     */
    public function saveComment(CommentRequest $request)
    {
        if ($this->commentService->saveComment($request)) {
            return redirect()->back()->with('success', __('messages.comment.create_success'));
        } 

        return redirect()->back()->with('error', __('messages.comment.create_error'));
    }

    /**
     * Delete user's comment
     *
     * @param \App\Models\Post $comment
     * @return void
     */
    public function deteteComment(Comment $comment)
    {
        if ($this->commentService->deteteComment($comment)) {
            return redirect()->back()->with('success', __('messages.comment.delete_success'));
        } 

        return redirect()->back()->with('error', __('messages.comment.delete_error'));
    }

    /**
     * Update user's comment
     *
     * @param \App\Http\Requests\User\CommentRequest $request
     * @param \App\Models\Post $comment
     * @return void
     */
    public function updateComment(CommentRequest $request, Comment $comment)
    {
        if ($this->commentService->updateComment($request, $comment)) {
            return redirect()->back()->with('success', __('messages.comment.change_success'));
        } 

        return redirect()->back()->with('error', __('messages.comment.change_error'));
    }
}
