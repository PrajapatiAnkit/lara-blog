@extends('admin.layouts.master')
@section('title','Add Blog')
@section('pageContent')
    <main class="main-content bgc-grey-100">
        <div id="mainContent">
            <div class="row gap-20 masonry pos-r">
                <div class="masonry-sizer col-md-6"></div>
                <div class="masonry-item col-md-6" style="height: 800px;">
                    <div class="bgc-white p-20 bd">
                        <h6 class="c-grey-900">Add Blog</h6>
                        <div class="mT-30">
                            <div id="showErrors"></div>
                               <div id="showSuccess" class="alert alert-success-2" style="display: none"></div>
                            <form id="addBlogForm" action="{{route('saveBlog')}}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="blogTitle" id="blogTitle"  class="form-control"  placeholder="Blog Title">
                                        <div class="error-messages" id="blogTitleError">blogTitleError</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                        <select name="blogCategory" id="blogCategory" class="form-control">
                                         {{--   Fetch all the categories and display to the dropdown--}}
                                            <option value="">Select</option>
                                            @if($categories)
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="error-messages" id="categoryError">categoryError</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea type="text" class="form-control" name="blogDescription" id="blogDescription" placeholder="Description"></textarea>
                                        <div class="error-messages" id="blogDescriptionError">blogDescriptionError</div>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="blogImage" id="blogImage"  class="form-control" >
                                        <div class="error-messages" id="blogImageError">blogImageError</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="hidden" name="validationRule" id="validationRule" value="addBlog">
                                        <button type="submit" class="btn btn-primary">Save</button>
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
