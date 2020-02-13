@extends('admin.layouts.master')
@section('title','Add Category')
@section('pageContent')
    <main class="main-content bgc-grey-100">
        <div id="mainContent">
            <div class="row gap-20 masonry pos-r">
                <div class="masonry-sizer col-md-6"></div>
                <div class="masonry-item col-md-6">
                    <div class="bgc-white p-20 bd">
                        <h6 class="c-grey-900">Add Category</h6>
                        <div class="mT-30">
                            <div id="showErrors"></div>

                                @if($errors->any())
                                    @foreach($errors->all() as $error)
                                     <div id="showSuccess" class="alert alert-danger-2">  {{$error}}  </div>
                                    @endforeach
                                @endif

                            <form method="post" action="{{route('saveCategory')}}">
                                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Category Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="categoryName" id="categoryName"  class="form-control"  placeholder="Category Name">
                                        <div class="error-messages" id="categoryNameError">categoryNameError</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="hidden" name="validationRule" id="validationRule" value="addCategory">
                                        <button type="submit" class="btn btn-primary">Add Category</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
