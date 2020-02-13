@extends('admin.layouts.master')
@section('title','Blog List')
@section('pageContent')
    <main class="main-content bgc-grey-100">
        <div id="mainContent">
            <div class="container-fluid">
{{--                <h4 class="c-grey-900 mT-10 mB-30">Data Tables</h4>--}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="bgc-white bd bdrs-3 p-20 mB-20">
                            <h4 class="c-grey-900 mB-20">Blog List</h4>
                            <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Blog Title</th>
                                    <th>Blog Category</th>
                                    <th>Description</th>
                                    <th>Added By</th>
                                    <th>Date</th>
                                </tr>
                                </thead>

                                <tbody>
                                 @if($blogs)
                                     @foreach($blogs as $sr=> $blog)
                                     <tr>
                                         <td>{{$sr+1}}</td>
                                         <td>{{$blog->blog_title}}</td>
                                         <td>{{$blog->category_name}}</td>
                                         <td>{{$blog->blog_description}}</td>
                                         <td>{{$blog->username}}</td>
                                         <td>{{date('d/m/Y',strtotime($blog->created_at))}}</td>
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
