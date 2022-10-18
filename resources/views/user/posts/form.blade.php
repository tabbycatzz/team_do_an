<div class="user-post container">
    <div class="row user-post-add" id="post-form">
        <div class="text-add-post">
            <h1>Thêm bài viết</h1>
        </div>
        <div class="col-md-8">
            <div class="card-title">
                <div class="card-body">
                    <div class="form-group">
                        <div class="text-article">
                            <h1>Chủ đề</h1>
                            <p class="text-dangerous">*</p>
                        </div>
                        {!! Form::text('title', old('title'), ['class' => 'form-control', 'id' => 'basic-default-name', 'placeholder' => 'Nhập chủ đề...']) !!}
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="text-article">
                            <h1>Mô tả</h1>
                            <p class="text-dangerous">*</p>
                        </div>
                        {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'style' => 'resize: none; height: 100px', 'placeholder' => 'Nhập mô tả...']) !!}
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="text-article">
                            <h1>Chi tiết bài viết</h1>
                            <p class="text-dangerous">*</p>
                        </div>
                        {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'id' => 'content-posts', 'placeholder' => 'Nhập chi tiết bài viết...']) !!}
                        @error('content')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-image">
                <div class="card-body">
                    <div class="text-article">
                        <h1>Hình ảnh</h1>
                        <h1 class="text-dangerous">*</h1>
                    </div>
                    <div class="form-group image-upload">
                        {!! Form::file('image', ['class' => 'form-control img-preview-post', 'id' => 'image']) !!}
                        {!! Html::decode(Form::label('image', '<i class="fa fa-plus-circle mt-1"></i>Tải lên<b class="mt-1">Chọn hình ảnh</b>', ['class' => 'text-muted']))!!}
                        <div class="text-center m-2">
                            <img class="image-post" src="{{ asset('admin/images/noimg.png') }}" id="preview-image-post">
                        </div>
                        @error('image')
                            <span class="text-danger mt-5">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="text-article">
                            <h1>Danh mục</h1>
                            <h1 class="text-dangerous">*</h1>
                        </div>
                        <div class="box">
                            <select class="form-control category_select" id="category_id">
                                <option value="0" selected disabled>Chọn danh mục lớn</option>
                                @foreach ($categories as $parent)
                                    <option value="{{ $parent->id }}">{{ $parent->title }}</option>
                                @endforeach
                            </select>
                            @error('parent_category')
                                <span class="text-danger mt-5">{{ $message }}</span>
                            @enderror
                            <br>
                            <select class="form-control children_select" name="category">
                                <option value="0" selected disabled>Chọn danh mục con</option>
                            </select>
                            @error('category')
                                <span class="text-danger mt-5">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row button-article">
                        <div class="col-12 text-center">
                            <a href="{{ url()->previous() }}" class="button-cancel">Trở về</a>
                            {!! Form::submit('Thêm', ['class'=> 'button-19']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('user/ckeditor4/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('content-posts', {
        filebrowserUploadUrl: "{{ route('post.upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form',
        extraPlugins: 'editorplaceholder',
        editorplaceholder: 'Nhập chi tiết bài viết...'
    }); 
</script> 
