@if (Auth::guard('user')->check())
    {!! Form::open(['route' => 'post.comment']) !!}
        {!! Form::hidden('post_id', $post->id) !!}
        {!! Form::hidden('parent_id', isset($comment) ? $comment->id :'') !!}
        {!! Form::textarea('content', '', ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Nhập bình luận ... ']) !!}
        @error('content')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="text-right">
            {!! Form::submit('Gửi bình luận', ['class' => 'btn btn-primary my-2']) !!}
        </div>
    {!! Form::close() !!}
@else
    <div class="card shadow-none py-3 mb-3 d-flex flex-row justify-content-center align-items-center">
        <a href="{{ route('login') }}">
            <i class="fa-solid fa-comment me-1"></i>
            <span>Đăng nhập để bình luận</span>
        </a>
    </div>
@endif
