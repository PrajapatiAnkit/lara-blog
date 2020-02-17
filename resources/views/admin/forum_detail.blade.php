@extends('admin.layouts.master')
@section('title','Forum detail')
@section('pageContent')
    <main class="main-content bgc-grey-100">
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
                                    <a href="#" class="btn btn-info btn-sm">Like <i class="fa  fa-thumbs-o-up"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="bgc-white bd bdrs-3 p-20 mB-20">
                            <h4 class="c-grey-900 mB-20">Write Comment </h4>
                            <form id="commentForm" action="{{route('saveComment')}}">
                                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <textarea class="form-control" id="commentText" name="commentText" placeholder="Write comment"></textarea>
                                    <div class="error-messages" id="commentTextError">commentTextError</div>
                                </div>
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

    <script>
        window.onload = function () {
            getCommentsById('{{ Request::segment(3)}}');
        }
    </script>
    <!-- Modal -->
@endsection
