@extends('admin.layouts.master')
@section('title','Forum')
@section('pageContent')
    <main class="main-content bgc-grey-100">
        <div id="mainContent">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="bgc-white bd bdrs-3 p-20 mB-20">
                            <h4 class="c-grey-900 mB-20">TimeLines </h4>
                            <div class="card">
                                <div class="card-header">Featured Posts</div>
                                @if($blogs)
                                    @foreach($blogs as $blog)
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="{{route('detail',['id'=> $blog->id,'slug'=>$blog->blog_slug])}}">{{$blog->blog_title}}</a> </h5>
                                            <p class="card-text">{{$blog->blog_description}}</p>
                                            <a href="#" class="btn btn-success btn-sm">Like <i class="fa  fa-thumbs-o-up"></i></a>
                                            <a href="#" class="btn btn-info btn-sm">Comment <i class="fa fa-commenting"></i></a>
                                        </div><hr/>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
