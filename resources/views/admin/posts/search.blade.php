<div class="search-post border-bottom py-2">
    {{ Form::open(['method' => 'GET', 'route' => ['admin.posts.index', $posts], 'class' => 'd-flex search-post-form']) }}
        <div class="mx-1 keyword">
            {!! Form::text('keyword', request()->keyword, ['class' => 'form-control', 'placeholder' => 'Search ... ']) !!}
        </div>
        {{ Form::button('Search', ['class' => 'btn btn-dark glow btn-search mx-1', 'type' => 'submit']) }}
    {{ Form::close() }}
</div>
