@extends('layouts.admin.app')
@section('content')
<section class="simple-validation">
    <div class="profile-admin">
        @include('layouts.admin.partials.notice')
        {!! Form::open(['method' => 'POST', 'route' => 'admin.profile.update', 'enctype' => 'multipart/form-data']) !!}
            @include('admin.profile.form')
        {!! Form::close() !!}
    </div>
</section>
@endsection
