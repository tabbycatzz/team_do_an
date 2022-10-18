{!! Form::open(['method' => 'POST', 'route' => ['post.update_comment', $comment]]) !!}
    {!! Form::textarea('content', $comment->content, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Nhập bình luận ... ']) !!}
    @error('content')
        <span class="text-danger">{{ $message }}</span>
    @enderror
    <div class="text-right">
        <div class="close-edit-{{ $comment->id }} btn btn-secondary">Đóng</div>
        {!! Form::submit('Lưu', ['class' => 'btn btn-primary my-2']) !!}
    </div>
{!! Form::close() !!}
