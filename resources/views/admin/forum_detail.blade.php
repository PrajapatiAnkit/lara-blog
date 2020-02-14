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
                                    <h5 class="card-title">Special title treatment</h5>
                                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
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
                               <button type="submit" name="writeCommentBtn" id="writeCommentBtn" class="btn btn-success btn-sm" style="float: right">Comment</button><br/>
                            </form>
                        </div>
                        <div class="bgc-white bd bdrs-3 p-20 mB-20">
                            <h4 class="c-grey-900 mB-20">Recent Comments </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><img src="http://127.0.0.1:8000/static/adminator/randomuser.me/api/portraits/men/10.jpg" width="30" style="border-radius: 50%;">  nice post</li>
                                <li class="list-group-item"><img src="http://127.0.0.1:8000/static/adminator/randomuser.me/api/portraits/men/10.jpg" width="30" style="border-radius: 50%;">  thank you</li>
                                <li class="list-group-item"><img src="http://127.0.0.1:8000/static/adminator/randomuser.me/api/portraits/men/10.jpg" width="30" style="border-radius: 50%;">  wonderfull</li>
                                <li class="list-group-item"><img src="http://127.0.0.1:8000/static/adminator/randomuser.me/api/portraits/men/10.jpg" width="30" style="border-radius: 50%;">  wow</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
@endsection
