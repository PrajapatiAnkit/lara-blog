@extends('admin.layouts.master')
@section('title','Catrgories')
@section('pageContent')
    <main class="main-content bgc-grey-100">
        <div id="mainContent">
            <div class="container-fluid">
                {{--                <h4 class="c-grey-900 mT-10 mB-30">Data Tables</h4>--}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="bgc-white bd bdrs-3 p-20 mB-20">
                            @if($message = Session::has('message'))
                                <div class="alert alert-success-2">
                                    {{Session::get('message')}}
                                </div>
                            @endif
                            <h4 class="c-grey-900 mB-20">Add Category <a href="{{route('addcategory')}}" class="btn btn-success">Add</a> </h4>
                            <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @if($category)
                                        @foreach($category as $sr=> $cat)
                                        <tr>
                                            <td>{{$sr+1}}</td>
                                            <td>{{$cat->category_name}}</td>
                                            <td>
                                                <a href="{{route('editCategory',['id'=>$cat->id])}}" class="btn btn-primary btn-sm">Edit <i class="fa fa-edit"></i></a>
                                                <a href="javaScript:void(0);" onclick='deleteCategory("{{route('deleteCategory',['id'=>$cat->id])}}");' class="btn btn-danger btn-sm">Delete <i class="fa fa-trash"></i></a>
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

    <!-- Modal -->
    <div class="modal fade" id="addEditCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add/Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
