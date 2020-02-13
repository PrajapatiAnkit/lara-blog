@extends('admin.layouts.master')
@section('title','Password Setting')
@section('pageContent')
    <main class="main-content bgc-grey-100">
        <div id="mainContent">
            <div class="row gap-20 masonry pos-r">
                <div class="masonry-sizer col-md-6"></div>
                <div class="masonry-item col-md-6">
                    <div class="bgc-white p-20 bd">
                        <h6 class="c-grey-900">Password Setting</h6>
                        <div class="mT-30">
                            <form id="resetPassword" action="{{route('validateCurrentPassword')}}">
                                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">

                                <div class="form-group">
                                    <label for="inputAddress">Current Password <span class="field-required">*</span></label>
                                    <input type="text" class="form-control" name="currentPassword" id="currentPassword" placeholder="Enter your current password">
                                    <div class="error-messages" id="currentPassword">currentPassword</div>
                                </div>
                                <div id="resetDiv" style="display: none">
                                    <div class="form-group">
                                        <label for="inputAddress">New Password <span class="field-required">*</span></label>
                                        <input type="text" class="form-control" name="newPassword" id="newPassword" placeholder="Enter your new password">
                                        <div class="error-messages" id="newPasswordError">newPasswordError</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress">Confirm Password <span class="field-required">*</span></label>
                                        <input type="text" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Enter confirm password">
                                        <div class="error-messages" id="confirmPasswordError">confirmPasswordError</div>
                                    </div>
                                </div>
                                <button type="submit" name="passwordResetBtn" id="passwordResetBtn" class="btn btn-primary">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
