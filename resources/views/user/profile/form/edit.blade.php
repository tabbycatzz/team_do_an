@extends('user.profile.index')
@section('user-profile-content')
<div class="user-profile-detail">
    <div class="container">
        <h3 class="form-title">Cập nhật thông tin cá nhân</h3>
            {!! Form::open(['method' => 'POST', 'route' => 'profile.update', 'enctype' => 'multipart/form-data']) !!}
                @include('layouts.user.partials.notice')
                <div class="row">
                    <div class="user-info">
                        <div class="row">
                            <div class="col-md-12 user-wrapper">
                                <div class="user-image-content">
                                    <img src="{{ isset($user) ? asset('/storage/images/avatar/' . $user->userProfile->avatar) : asset('admin/app-assets/images/pages/no_image_available.jpg') }}" 
                                        name="avatar" class="user-image" id="user-image" width="100%">
                                    <div class="upload-image">
                                        {!! Form::file('avatar', ['class' => 'form-control img-preview-user', 'id' => 'image']) !!}
                                        {!! Html::decode(Form::label('image', '<div class="icon-wrapper"><i class="fa-solid fa-photo-film"></i></div>', ['class' => 'text-muted'])) !!}
                                    </div>
                                </div>
                                @error('avatar')
                                    <span class="text-danger mb-4">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    {!! Form::label('first_name', 'First name') !!}
                                    {!! Form::text(
                                        'first_name',
                                        isset($user->userProfile->first_name) ? $user->userProfile->first_name : old('first_name'),
                                        ['class' => 'form-control', 'placeholder' => 'Enter first name']
                                    ) !!}
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 col-mt">
                                    {!! Form::label('last_name', 'Last name') !!}
                                    {!! Form::text(
                                        'last_name',
                                        isset($user->userProfile->last_name) ? $user->userProfile->last_name : old('last_name'),
                                        ['class' => 'form-control', 'placeholder' => 'Enter last name']
                                    ) !!}
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-mb">
                                    {!! Form::label('email', 'Email') !!}
                                    {!! Form::text(
                                        'email',
                                        isset($user->email) ? $user->email : old('email'),
                                        ['class' => 'form-control', 'placeholder' => 'Enter email']
                                    ) !!}
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {!! Form::label('phone', 'Phone') !!}
                                    {!! Form::text(
                                        'phone',
                                        isset($user->userProfile->phone) ? $user->userProfile->phone : old('phone'),
                                        ['class' => 'form-control', 'placeholder' => 'Phone']
                                    ) !!}
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-mb">
                                    {!! Form::label('address', 'Address') !!}
                                    {!! Form::text(
                                        'address',
                                        isset($user->userProfile->address) ? $user->userProfile->address : old('address'),
                                        ['class' => 'form-control', 'placeholder' => 'Address']
                                    ) !!}
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {!! Form::label('province', 'Province') !!}
                                    {!! Form::text(
                                        'province',
                                        isset($user->userProfile->province) ? $user->userProfile->province : old('province'),
                                        ['class' => 'form-control', 'placeholder' => 'Province']
                                    ) !!}
                                    @error('province')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {!! Form::label('gender', 'Gender') !!}
                                    {!! Form::select(
                                        'gender',
                                        [\App\Enums\Genre::MALE => 'Male', \App\Enums\Genre::FEMALE => 'Female'],
                                        isset($user->userProfile->gender) ? $user->userProfile->gender : old('gender'),
                                        ['class'=>'form-control']
                                    )!!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="action">
                        {!! Form::submit('Update', ['class'=> 'btn btn-primary btn-update-profile']) !!}
                    </div>
                </div>
            {{ Form::close() }}
       </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('input[name="avatar"]').on('change', function () {
                var file = $('.img-preview-user').get(0).files[0];

                if (file) 
                {
                    var reader = new FileReader();

                    reader.onload = function () {
                        $('#user-image').attr('src', reader.result);
                    }

                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endpush