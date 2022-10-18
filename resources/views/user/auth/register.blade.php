@extends('layouts.user.unauth_app')
@section('content-user')
<section class="register-validation">
    <div class="text-center m-2">
        <img src="{{ asset('images/favicon.png') }}" width="20%" class="icon">
    </div>
    @include('layouts.user.partials.notice')
    <div class="register-form">
        <div class="m-2 p-3">
            <h4>Đăng ký tài khoản</h4>
            <p>Chào mừng bạn đến <b>Nền tảng chúng tôi!</b> Tham gia cùng chúng tôi để tìm kiếm thông tin hữu ích cần thiết để cải thiện kỹ năng IT của bạn. Vui lòng điền thông tin của bạn vào biểu mẫu bên dưới để tiếp tục.</p>
            {!! Form::open(['id' => 'registerForm', 'name' => 'registerForm', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group row user-name">
                    <div class="col first-name">
                        {!! Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => 'Tên của bạn']) !!}
                        <span class="text text-danger error-text first_name_error"></span>
                    </div>
                    <div class="col">
                        {!! Form::text('last_name', old('last_name'),['class' => 'form-control', 'placeholder' => 'Họ và tên đệm']) !!}
                        <span class="text text-danger error-text last_name_error"></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::file('avatar', ['class' => 'form-control img-preview-user d-none', 'id' => 'image-user-register']) !!}
                    {!! Form::label('image-user-register', 'Chọn ảnh đại diện', ['class' => 'form-control text-muted']) !!}
                    <div class="align-items-center m-2 d-flex flex-column">
                        <img src="{{ asset('images/noimg.png') }}" class="preview-avatar-user" width="50%">
                        <span class="text text-danger error-text avatar_error"></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::text('address', old('address'), ['class' => 'form-control', 'placeholder' => 'Địa chỉ của bạn']) !!}
                    <span class="text text-danger error-text address_error"></span>
                </div>
                <div class="form-group">
                    {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => 'Số điện thoại của bạn']) !!}
                    <span class="text text-danger error-text phone_error"></span>
                </div>
                <div class="form-group">
                    {!! Form::select('gender', ['' => 'Chọn giới tính của bạn', '0' => 'Nữ', '1' => 'Nam'], old('gender'), ['class' => 'form-select']) !!}
                    <span class="text text-danger error-text gender_error"></span>
                </div>
                <div class="form-group">
                    {!! Form::text('province', old('province'), ['class' => 'form-control', 'placeholder' => 'Tên tỉnh của bạn']) !!}
                    <span class="text text-danger error-text province_error"></span>
                </div>
                <div class="form-group">
                    {!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Địa chỉ email của bạn']) !!}
                    <span class="text text-danger error-text email_error"></span>
                </div>
                <div class="form-group">
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Mật khẩu']) !!}
                    <span class="text text-danger error-text password_error"></span>
                </div>
                <div class="form-group">
                    {!! Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => 'Xác nhận mật khẩu của bạn']) !!}
                    <span class="text text-danger error-text confirm_password_error"></span>
                </div>
                <div class="form-group mt-10">
                    <div class="d-flex flex-row">
                        {!! Form::checkbox('agree_terms', old('agree_terms'), false, ['class' => 'check-terms me-1']) !!}
                        {!! Html::decode(Form::label('agree_terms', 'Tôi đồng ý <b class="text-primary">Điều khoản dịch vụ của chúng tôi</b>')) !!}
                    </div>
                    <span class="text text-danger error-text agree_terms_error"></span>
                </div>
                <div class="form-group d-grid">
                    {!! Form::submit('Đăng ký', ['class' => 'btn btn-primary p-2']) !!}
                </div>
            {!! Form::close() !!}
            <div class="text-center mb-2">
                <span>Bạn đã có tài khoản?</span>
                <a href="{{ route('login') }}">Đăng nhập</a>
            </div>
            <div class="row form-group align-middle">
                <div class="col"><hr/></div>
                <div class="col text-center"><b>Đăng nhập với</b></div>
                <div class="col"><hr/></div>
            </div>
            <div class="form-group row another-login">
                <div class="col my-1">
                    <a href="#" class="btn form-control d-flex">
                        <i class="fa-brands fa-facebook-f icon-fa"></i>
                        <span>Facebook</span>
                    </a>
                </div>
                <div class="col my-1">
                    <a href="#" class="btn form-control d-flex">
                        <i class="fa-brands fa-google icon-fa"></i>
                        <span>Google</span>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ url('login/github') }}" class="btn form-control d-flex">
                        <i class="fa-brands fa-github icon-fa"></i>
                        <span>Github</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function($){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $('#registerForm').submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('register_save') }}',
                method: 'POST',
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function () {
                    $(document).find('span.error-text').text('');
                },
                success: function (res) {
                    if (res.status == 400) {
                        $.each(res.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                            $('#registerForm').find('input:password').val('');
                        });
                    } else {
                        $('#registerForm').find('input:text, input:password, input:file, textarea, checkbox, select').val('');
                        $('#registerForm').find('.preview-avatar-user').attr('src', '{{ asset('images/noimg.png') }}');
                        toastr.success(res.message);
                    }
                }
            });
        });
    });
</script>
@endpush
