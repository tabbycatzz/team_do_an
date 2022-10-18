@extends('user.profile.index')

@section('user-profile-content')
    <div class="container">
        <h2>Thay đổi mật khẩu</h2>
        @include('layouts.user.partials.notice')
        {!! Form::open(['method' => 'POST', 'route' => 'change_password.save']) !!}
        <div class="form-group">
            {!! Form::label('Old Password:', 'Mật khẩu cũ') !!}
            {!! Form::password('old_password', ['class' => 'form-control', 'placeholder' => 'Nhập mật khẩu cũ']) !!}
            @error ('old_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div> 
        <div class="form-group">
            {!! Form::label('New Password', 'Mật khẩu mới') !!}
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Nhập mật khẩu mới']) !!}
            @error ('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('confirm_password', 'Nhập lại mật khẩu mới') !!}
            {!! Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => 'Nhập lại mật khẩu mới']) !!}
            @error ('confirm_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group d-grid">
            {!! Form::submit('Xác nhận', ['class' => 'btn btn-primary p-2']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
