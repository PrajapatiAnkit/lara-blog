@extends('admin.layouts.master')
@section('title','Profile')
@section('pageContent')
    {{-- This layout is the profile update page of the user  --}}

    <main class="main-content bgc-grey-100">
        <div id="mainContent">
            <div class="row gap-20 masonry pos-r">
                <div class="masonry-sizer col-md-6"></div>
                <div class="masonry-item col-md-6">
                    <div class="bgc-white p-20 bd">
                        <h6 class="c-grey-900">Profile Setting</h6>
                        {{-- Show the success message on profile update --}}

                    @if(Session::has('success'))
                            <div id="showSuccess" class="alert alert-success-2">
                                {{Session('success')}}
                            </div>
                        @endif

                        {{-- Show the error message on profile update if any error comes --}}
                        @if(Session::has('error'))
                            <div id="showSuccess" class="alert alert-danger-2">
                                {{Session('error')}}
                            </div>
                        @endif
                        <div class="mT-30" style="height: 500px;">
                            <form method="post" action="{{route('updateProfile')}}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <label for="inputAddress">Name <span class="field-required">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{$profileData->name}}" placeholder="Enter your name">
                                    <div class="error-messages-show" id="nameError">{{$errors->first('name')}}</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Email <span class="field-required">*</span></label>
                                    <input type="text" class="form-control" name="email" id="email" value="{{$profileData->email}}" placeholder="Enter your email">
                                    <div class="error-messages-show" id="emailError">{{$errors->first('email')}}</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Contact <span class="field-required">*</span></label>
                                    <input type="text" class="form-control" name="contact" id="contact" value="{{$profileData->contact}}"  placeholder="Enter your contact" maxlength="10">
                                    <div class="error-messages-show" id="contactError">{{$errors->first('contact')}}</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Profile Pic <span class="field-required">*</span></label>
                                    <input type="file" class="form-control" name="profilePic" id="profilePic">
                                    <input type="hidden" name="preProfilePic" id="preProfilePic" value="{{$profileData->profile}}"/>
                                    <div class="error-messages-show" id="profilePicError">{{$errors->first('profilePic')}}</div>
                                </div>
                                <button type="submit" name="updateProfileBtn" id="updateProfileBtn" class="btn btn-primary">Update Profile <i class="fa fa-check"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
