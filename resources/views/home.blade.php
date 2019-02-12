@extends('layouts.app')

@section('title','Youtube Search')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form id="searchform" action="#" class="form-inline align-items-center">
            <input id="search" type="text" class="form-control" name="search" placeholder="Search...">
            <button type="submit" class="btn btn-outline-dark"><i class="fas fa-search"></i></button>
        </form>
        <div class="col-md-9" id="result-box"></div>
    </div>
</div>
@endsection
