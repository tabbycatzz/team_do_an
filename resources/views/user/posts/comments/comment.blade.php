<div class="comment-post my-3">
    <h5 class="font-weight-bold">Bình luận</h5>
    @include('user.posts.comments.form.addParentComment')
    <div class="content-comment mt-2">
        @forelse ($post->comment as $key => $comment)
            <div class="mb-3 border border-1 rounded py-4 px-3" id="comment-container">
                <div class="d-flex mb-1 px-3">
                    <div class="col-xs-2 col-sm-2 col-md-1 p-1">
                        <a href="#">
                            <img class="rounded-circle" src="{{ asset('/storage/images/avatar/'.$comment->user->userProfile->avatar) }}">
                        </a>
                    </div>
                    <div class="col-xs-10 col-sm-10 col-md-11 row info-comment pe-0">
                        <div class="col-xs-8 col-sm-8 col-md-8 d-flex flex-column justify-content-center ps-0">
                            <b>{{ $comment->user->userProfile->full_name }}</b>
                            <div class="d-flex flex-row mt-2 comment-time">
                                <span class="me-1">{{ $comment->getDateFormatAttribute('created_at') }}</span>
                                <i class="fa-solid fa-pencil icon"></i>
                            </div>
                        </div>
                        @if (Auth::guard('user')->check() && ($comment->user_id == Auth::guard('user')->user()->id))
                            <div class="col-xs-4 col-sm-4 col-md-4 d-flex flex-row-reverse">
                                {!! Form::open(['route' => ['post.delete_comment', $comment], 'method' => 'DELETE', 'onsubmit' => 'return confirm("Bạn có chắc muốn xoá ?")', 'class' => 'ms-2']) !!}
                                    <button type="submit" class="btn btn-light">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                {!! Form::close() !!}
                                <div id="icon-edit-{{ $comment->id }}">
                                    <button value="{{ $comment->id }}" class="btn btn-light" id="btn-edit-comment">
                                        <i class="fa-solid fa-file-pen"></i>
                                    </button>
                                </div>
                            </div>
                        @else
                            <div class="col-4 d-flex flex-row-reverse"></div>
                        @endif
                    </div>
                </div>
                <div class="d-flex">
                    <div class="col-xs-2 col-sm-2 col-md-1"></div>
                    <div class="col-xs-10 col-sm-10 col-md-11 row">
                        <p>{{ $comment->content }}</p>
                        <div class="form-edit" id="form-edit-{{ $comment->id }}">
                            @include('user.posts.comments.form.editComment')
                        </div>
                        @if (Auth::guard('user')->check())
                            <div>
                                <div class="d-flex flex-row reply-comment mb-1">
                                    <div class="d-flex flex-row">
                                        <i class="fa-solid fa-chevron-up mx-1"></i>
                                        <i class="fa-solid fa-chevron-down mx-1"></i>
                                    </div>
                                    <span class="text-muted mx-1">|</span>
                                    <div id="icon-reply-{{ $comment->id }}" class="icon-reply mx-1">
                                        <button class="btn btn-light mb-1 text-primary" value="{{ $comment->id }}" id="btn-reply-comment">
                                            Trả lời
                                        </button>
                                    </div>
                                    <span class="mx-1">Chia sẻ</span>
                                    <a href="#" class="ms-2">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </a>
                                </div>
                            </div>
                            <div id="form-reply-{{ $comment->id }}" class="form-reply">
                                @include('user.posts.comments.form.addRepliesComment', ['comment' => $comment])
                            </div>
                        @endif
                        @foreach ($comment->replies as $key => $reply)
                            <div class="d-flex mb-1">
                                <div class="col-xs-2 col-sm-2 col-md-1 p-1">
                                    <a href="#">
                                        <img class="rounded-circle" src="{{ asset('/storage/images/avatar/'.$reply->user->userProfile->avatar) }}">
                                    </a>
                                </div>
                                <div class="col-xs-10 col-sm-10 col-md-11 row info-comment pe-0">
                                    <div class="col-8 d-flex flex-column justify-content-center ps-0">
                                        <b>{{ $reply->user->userProfile->full_name }}</b>
                                        <div class="d-flex flex-row mt-2 comment-time">
                                            <span class="me-1">{{ $reply->getDateFormatAttribute('created_at') }}</span>
                                            <i class="fa-solid fa-pencil icon"></i>
                                        </div>
                                    </div>
                                    @if (Auth::guard('user')->check() && ($reply->user_id == Auth::guard('user')->user()->id))
                                        <div class="col-4 d-flex flex-row-reverse">
                                            {!! Form::open(['route' => ['post.delete_comment', $reply], 'method' => 'DELETE', 'onsubmit' => 'return confirm("Bạn có chắc muốn xoá ?")', 'class' => 'ms-2']) !!}
                                                <button type="submit" class="btn btn-light">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            {!! Form::close() !!}
                                            <div id="icon-edit-{{ $reply->id }}">
                                                <button value="{{ $reply->id }}" class="btn btn-light" id="btn-edit-comment">
                                                    <i class="fa-solid fa-file-pen"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-4 d-flex flex-row-reverse">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-xs-2 col-sm-2 col-md-1"></div>
                                <div class="col-xs-10 col-sm-10 col-md-11 d-flex flex-column ps-0">
                                    <p>{{ $reply->content }}</p>
                                    <div id="form-edit-{{ $reply->id }}" class="form-edit">
                                        @include('user.posts.comments.form.editRepliesComment', ['reply' => $reply])
                                    </div>
                                    @if (Auth::guard('user')->check())
                                        <div>
                                            <div class="d-flex flex-row reply-comment mb-1">
                                                <div class="d-flex flex-row">
                                                    <i class="fa-solid fa-chevron-up mx-1"></i>
                                                    <i class="fa-solid fa-chevron-down mx-1"></i>
                                                </div>
                                                <span class="text-muted mx-1">|</span>
                                                <div id="icon-reply-{{ $reply->id }}" class="icon-reply mx-1">
                                                    <button class="btn btn-light mb-1 text-primary" value="{{ $reply->id }}" id="btn-reply-comment">
                                                        Trả lời
                                                    </button>
                                                </div>
                                                <span class="mx-1">Chia sẻ</span>
                                                <a href="#" class="ms-2">
                                                    <i class="fa-solid fa-ellipsis"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div id="form-reply-{{ $reply->id }}" class="form-reply">
                                            @include('user.posts.comments.form.addRepliesComment', ['comment' => $comment])
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <div class="card shadow-none py-3">
                <span class="text-center">Chưa có bình luận nào</span>
            </div>
        @endforelse
    </div>
</div>
