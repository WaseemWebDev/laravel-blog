@extends('layouts.app')
@section('content')
@include('navbar')
@include('carousel')
<br />
<center>
    <h2>All Posts</h2>
</center>

<div class="container">
    <div class="row">

        <div class="col-md-4">
            <form>
                <div class="input-group mb-3">

                    @csrf
                    <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                    <input type="text" class="form-control" placeholder="search post" id="search-post">


                    <div class="input-group-append">
                        <span id="search" class="input-group-text">search</span>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-4" id="autocomplete">
        </div>
    </div>

</div>

<br /><br />
<div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    <div class="row">

        @foreach ($posts as $post)
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src={{ asset('images/'.$post->image) }} alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text">{{$post->description}}</p>
                    <a href="/readmore/{{$post->id}}" class="btn btn-primary">Read more</a>
                    <form method="post" action="/delete">
                        @csrf
                        <input type="hidden" value={{$post->id}} name="postid" />
                        <input type="submit" class="btn btn-danger btn-sm" value="delete" />
                    </form>

                </div>
            </div>
        </div>
        @endforeach

    </div>
    <br />
    <input type="hidden" id="hidden" />
</div>
<div style="display:flex; justify-content:center">{{ $posts->links() }}</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#search-post").keyup(function(e) {
            e.preventDefault();
            var searchValue = $(this).val();
            if (searchValue !== "") {

                $.ajax({
                    type: 'post'
                    , url: '/search'
                    , data: {
                        _token: $("#csrf").val()
                        , value: searchValue
                    }
                    , success: function(data) {
                        $("#autocomplete").html(data);
                        $(".listdata").click(function() {
                            $("#hidden").val($(this).attr("data-id"))
                            $("#search-post").val($(this).html())
                            $('.listdata').hide()
                        })
                    }

                });
                $("#search").click(function() {
                    id = $("#hidden").val();
                    window.location.href = "/readmore/" + id;
                })
            } else {
                $('.listdata').hide()
            }

        });


    });

</script>
@endsection
