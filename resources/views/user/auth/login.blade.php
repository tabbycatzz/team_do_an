@extends('layouts.user.unauth_app')
@section('content-user')
<section class="login-validation">
    @include('layouts.user.partials.notice')
    <div class="login-form m-2 py-4">
        <h4 class="text-center mb-4">Đăng nhập</h4>
        <hr/>
        @include('user.auth.AnotherLogin.anotherLogin')
        <div class="row form-group align-middle">
            <div class="col-3"><hr/></div>
            <div class="col-6 text-center">Hoặc đăng nhập với email</div>
            <div class="col-3"><hr/></div>
        </div>
        {!! Form::open(['method' => 'POST', 'route' => 'login_save']) !!}
            <div class="form-group">
                {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Địa chỉ email của bạn']) !!}
                @error ('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Mật khẩu']) !!}
                @error ('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3 text-right text-bold-300">
                <a href="{{ route('forgot_password') }}">Quên mật khẩu?</a>
            </div>
            <div class="form-group d-grid">
                {!! Form::submit('Đăng nhập', ['class' => 'btn btn-primary p-2']) !!}
            </div>
        {!! Form::close() !!}
        <hr/>
        <div class="text-center">
            <span>Bạn chưa có tài khoản?</span>
            <a href="{{ route('register') }}">Đăng ký</a>
        </div>
    </div>
</section>
@endsection
