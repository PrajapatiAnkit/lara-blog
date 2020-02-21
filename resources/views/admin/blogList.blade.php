@extends('admin.layouts.master')
@section('title','Blog List')
@section('pageContent')
    <main class="main-content bgc-grey-100">
        <div id="mainContent">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="bgc-white bd bdrs-3 p-20 mB-20">
                            <h4 class="c-grey-900 mB-20">Blog List</h4>
                        {{--  Display the error or success message on update and delete of the blog  --}}
                            @if($message = Session::has('message'))
                                <div class="alert alert-success-2">
                                    {{Session::get('message')}}
                                </div>
                            @endif

                            <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Blog Title</th>
                                    <th>Blog Category</th>
                                    <th>Description</th>
                                    <th>Added By</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                            {{--   If we have blogs the loop them in a table      --}}
                                 @if($blogs)
                                     @foreach($blogs as $sr=> $blog)
                                     <tr>
                                         <td>{{$sr+1}}</td>
                                         <td>{{$blog->blog_title}}</td>
                                         <td>{{$blog->category_name}}</td>
                                         <td>{{$blog->blog_description}}</td>
                                         <td>{{$blog->username}}</td>
                                         <td>{{date('d/m/Y',strtotime($blog->created_at))}}</td>
                                         <td>
                                             <a href="{{route('editBlog',['id'=>$blog->id])}}" class="btn btn-primary btn-sm">Edit <i class="fa fa-edit"></i></a>
                                             <a href="javaScript:void(0);" onclick='deleteBlog("{{route('deleteBlog',['id'=>$blog->id])}}");' class="btn btn-danger btn-sm">Delete <i class="fa fa-trash"></i></a>
                                         </td>
                                     </tr>
                                     @endforeach
                                     @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
