@extends('admin.layouts.master')
@section('title','Forum detail')
@section('pageContent')
    <main class="main-content bgc-grey-100" xmlns="http://www.w3.org/1999/html">
        <div id="mainContent">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="bgc-white bd bdrs-3 p-20 mB-20">
                            <h4 class="c-grey-900 mB-20">Post Detail </h4>
                            <div class="card">
                                <div class="card-header">
                                    Featured Posts Detail
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{$blog->blog_title}}</h5>
                                    <p class="card-text">{{$blog->blog_description}}</p>

                                    <a href="javaScript:void(0)" style="color: {{in_array(Auth::id(),explode(',',$blog->liked_by_users))?'red':''}}" id="likeBtn{{$blog->id}}" onclick="doLikeDislike('{{$blog->id}}','like');"><i class="fa fa-thumbs-o-up"  style="font-size: 20px;" ></i><span id="likeCountLabel{{$blog->id}}">{{$blog->like_count}}</span></a>
                                    <a href="javaScript:void(0)" style="color: {{in_array(Auth::id(),explode(',',$blog->disliked_by_users))?'red':''}}" id="dislikeBtn{{$blog->id}}" onclick="doLikeDislike('{{$blog->id}}','dislike');"><i class="fa fa-thumbs-o-down"  style="font-size: 20px;"><span id="dislikeCountLabel{{$blog->id}}">{{$blog->dislike_count}}</span></i></a>
                                    <a href="javaScript:void(0)"> <i class="fa fa-commenting" style="font-size: 20px;"></i> <span id="commentCountLabel">{{$blog->comment_count}}</span></a>

                                </div>
                            </div>
                        </div>
                        <div class="bgc-white bd bdrs-3 p-20 mB-20" id="commentSection">
                            <h4 class="c-grey-900 mB-20">Write Comment </h4>
                            <form id="commentForm" action="{{route('saveComment')}}">
                                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <textarea class="form-control" id="commentText" name="commentText" placeholder="Write comment"></textarea>
                                    <div class="error-messages" id="commentTextError">commentTextError</div>
                                </div>
                                <input type="hidden" name="editCommentId" id="editCommentId" value="">
                                <input type="hidden" name="blogId" id="blogId" value="{{ Request::segment(3)}}">
                               <button type="submit" name="writeCommentBtn" id="writeCommentBtn" class="btn btn-success btn-sm" style="float: right">Comment</button><br/>
                            </form>
                        </div>
                        <div class="bgc-white bd bdrs-3 p-20 mB-20">
                            <h4 class="c-grey-900 mB-20">Recent Comments </h4>
                            <ul class="list-group list-group-flush" id="commentsData">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <input type="hidden" name="myUserId" id="myUserId" value="{{Auth::id()}}">

    <script>
        window.onload = function () {
            getCommentsById('{{ Request::segment(3)}}');
        }
    </script>
    <!-- Modal -->
@endsection
