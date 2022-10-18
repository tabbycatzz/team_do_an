<div class="row" id="info-admin-form">
    <div class="col-md-12">
        <div class="card mb-1">
            <h4 class="text-center my-1">Update personal information</h4>
        </div>
        <div class="card">
            <div class="avatar-admin text-center my-1">
                <div class="avatar-preview">
                    @if ($infoAdmin->userProfile->avatar)
                        <img class="preview-avatar-admin" src="{{ asset('/storage/images/avatar/'.$infoAdmin->userProfile->avatar) }}">
                    @elseif ($infoAdmin->userProfile->gender == \App\Enums\Genre::MALE)
                        <img class="preview-avatar-admin" src="/admin/app-assets/images/avatar-male.png">
                    @else
                        <img class="preview-avatar-admin" src="/admin/app-assets/images/avatar-female.png">
                    @endif
                </div>
                <div class="avatar-file">
                    {!! Form::file('avatar', ['class' => 'd-none', 'id' => 'avatar-file-admin']) !!}
                    {!! Html::decode(Form::label('avatar-file-admin', '<div class="avatar-file-label d-flex flex-row btn-primary"><i class="bx bx-photo-album"></i><span class="ml-1">Edit</span></div>', ['class' => 'text-muted'])) !!}
                </div>
            </div>
            <div class="card-body">
                <div class="personal-information-admin row">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            {!! Form::label('first_name', 'First name') !!} 
                            <span class="text-danger">*</span>
                            {!! Form::text('first_name', $infoAdmin->userProfile->first_name, ['class' => 'form-control', 'placeholder' => 'Please enter first name']) !!}
                            @error('first_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('last_name', 'Last name') !!} 
                            <span class="text-danger">*</span>
                            {!! Form::text('last_name', $infoAdmin->userProfile->last_name, ['class' => 'form-control', 'placeholder' => 'Please enter last name']) !!}
                            @error('last_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'Email') !!} 
                            <span class="text-danger">*</span>
                            {!! Form::text('email', $infoAdmin->email, ['class' => 'form-control', 'placeholder' => 'Please enter email']) !!}
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('address', 'Address') !!} 
                            <span class="text-danger">*</span>
                            {!! Form::text('address', $infoAdmin->userProfile->address, ['class' => 'form-control', 'placeholder' => 'Please enter address']) !!}
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            {!! Form::label('province', 'Province') !!} 
                            <span class="text-danger">*</span>
                            {!! Form::text('province', $infoAdmin->userProfile->province, ['class' => 'form-control', 'placeholder' => 'Please enter province']) !!}
                            @error('province')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('phone', 'Phone') !!} 
                            <span class="text-danger">*</span>
                            {!! Form::text('phone', $infoAdmin->userProfile->phone, ['class' => 'form-control', 'placeholder' => 'Please enter phone']) !!}
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('gender', 'Gender') !!} 
                            <span class="text-danger">*</span>
                            {!! Form::select('gender', \App\Enums\Genre::getKeys(), $infoAdmin->userProfile->gender, ['class' => 'form-control', 'placeholder' => 'Please enter gender']) !!}
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>
</div>
