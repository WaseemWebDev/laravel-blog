@extends('layouts.app')
@include('navbar')

<div class="container-fluid">
    <br /><br />
    <div class="row justify-content-center ">

        <div class="col-md-9 shadow bg-white" style="height:600px; width:70%;">
        
            <img class="img-fluid" style="max-height:590px; width:100%" src={{asset('images/'.$post->image) }} alt="Card image cap" />
            <br /><br />
            <h2 style="color:blue" class="card-title">{{$post->title}}</h2>
            <h4 class="card-text">{{$post->description}}</h4>
          
        </div>
    </div>

</div>
<br /><br />
<div class="container-fluid">
    <br /><br />
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    <div class="row  ">

        <div class="col-md-6  bg-white">
            <div class="card">
                <div class="card-header">
                    comment on post
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <form method="post" action="/comment">
                            @csrf
                            <textarea col="90" row="40" style="height:130px; width:90%" name="comment"></textarea>
                            <input type="hidden" value={{request()->id}} name="id" />
                            <input type="submit" class="btn btn-primary" />
                        </form>
                    </blockquote>

                </div>
            </div>
        </div>
    </div>

</div>
<br /><br />
<div class="container">
    <div class="row">
        <div class="col-md-5">
            @foreach($comments as $comment)
            <div class="card">
                <div class="card-header">
                    comments
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p>{{$comment->comment}}</p>
                    </blockquote>
                </div>
            </div>
            @endforeach

        </div>
    </div>

</div>
