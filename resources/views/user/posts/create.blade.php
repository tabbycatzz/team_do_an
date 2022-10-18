@extends('layouts.user.app')

@section('content')
<section class="simple-validation">
    <div class="user-post">
        @include('layouts.user.partials.notice')
        {{ Form::open(['method' => 'POST', 'route' => 'post.store', 'enctype' => 'multipart/form-data']) }}
            @include('user.posts.form')
        {{ Form::close() }}
    </div>
</section>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('change', '.category_select', function() {
            var category_id = $(this).val();
            var div = $(this).parent();
            var op = " ";

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'get',
                url: "{{ route('post.find') }}",
                data: {'id': category_id},
                success:function(data) {
                    op += '<option value="0" selected disabled>Chọn danh mục con</option>'
                    for (var i = 0; i < data.length; i++) {
                        op += '<option value="' + data[i] . id +'">' + data[i] . title + '</option>';
                    }
                    div.find('.children_select').html(" ");
                    div.find('.children_select').append(op);
                },
                error:function() {
                    console.log('error');
                }
            })
        })
    });
</script>
@endpush
