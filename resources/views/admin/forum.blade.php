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
                                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">

                            @if($blogs)
                                    @foreach($blogs as $blog)
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="{{route('detail',['id'=> $blog->id,'slug'=>$blog->blog_slug])}}">{{$blog->blog_title}}</a> </h5>
                                            <p class="card-text">{{$blog->blog_description}}</p>
                                            <a href="javaScript:void(0)" style="color:" id="likeBtn{{$blog->id}}" onclick="doLikeDislike('{{$blog->id}}','like');"><i class="fa fa-thumbs-o-up"  style="font-size: 20px;" ></i><span id="likeCountLabel{{$blog->id}}">{{$blog->like_count}}</span></a>
                                            <a href="javaScript:void(0)" style="color:" id="dislikeBtn{{$blog->id}}" onclick="doLikeDislike('{{$blog->id}}','dislike');"><i class="fa fa-thumbs-o-down"  style="font-size: 20px;"><span id="dislikeCountLabel{{$blog->id}}">{{$blog->dislike_count}}</span></i></a>
                                            <a href="{{route('detail',['id'=> $blog->id,'slug'=>$blog->blog_slug])}}"> <i class="fa fa-commenting" style="font-size: 20px;"></i> {{$blog->comment_count}}</a>

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
