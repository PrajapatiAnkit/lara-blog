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
                                            <ul class="list-group list-group-flush" id="commentsData" style="margin-top: 20px;">
                                                @foreach($blog->comments as $comment)
                                                    <li class="list-group-item"><img src="http://127.0.0.1:8000/static/adminator/randomuser.me/api/portraits/men/10.jpg" width="30" style="border-radius: 50%;">{{$comment->comment}}</li>
                                                @endforeach

                                            </ul>

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
