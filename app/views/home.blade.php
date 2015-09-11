@extends('layouts.master')

@section('title')
Home
@stop

@section('content')
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>
 
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="/images/polar-bear.jpg" alt="...">
      <div class="carousel-caption">
          <h1>Bare Bones</h1>
      </div>
    </div>
    <div class="item">
      <img src="/images/griz.jpg" alt="...">
      <div class="carousel-caption">
          <h1>Create</h1>
      </div>
    </div>
    <div class="item">
      <img src="/images/grizzly.jpg" alt="...">
      <div class="carousel-caption">
          <h1>Careers</h1>
      </div>
    </div>
  </div>
 
  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div> <!-- Carousel -->


@stop