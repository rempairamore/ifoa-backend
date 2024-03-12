<?php

print_r($libri);

?>

@extends ('templates.layout')

@section('title', 'Ecco un bel titolone')

@section('content')

@if($libri)

<div class="card-group">
    @foreach($libri as $key => $value)
    <div class="card">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
        <h5 class="card-title">{{$value->title}}</h5>
        <p class="card-text"></p>
        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
        </div>
    </div>
  @endforeach
</div>
@endif

@endsection
