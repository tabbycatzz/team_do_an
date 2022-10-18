{!! Form::open(['route' => 'post.comment']) !!}
    {!! Form::hidden('post_id', $post->id) !!}
    {!! Form::hidden('parent_id', isset($comment) ? $comment->id :'') !!}
    {!! Form::textarea('content', '', ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Nhập bình luận ... ']) !!}
    @error('content')
        <span class="text-danger">{{ $message }}</span>
    @enderror
    <div class="text-right">
        <div class="close-add-comment btn btn-secondary">Đóng</div>
        {!! Form::submit('Gửi bình luận', ['class' => 'btn btn-primary my-2']) !!}
    </div>
{!! Form::close() !!}
