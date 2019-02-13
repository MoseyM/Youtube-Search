@extends('layouts.app')

@section('title', $data->snippet->title)

@section('content')
<div class="col-7 mx-auto">
        <a href="{{url()->previous()}}"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
        <h1>{{ $data->snippet->title}}</h1>
        <div class="embed-responsive embed-responsive-16by9">
            <iframe src="https://www.youtube.com/embed/{{$data->id->videoId}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <p class="pt-1">{{$data->snippet->description}}</p>
    </div>
@endsection