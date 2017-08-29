@extends('main')

@section('title', ' | Home')

@section('content')
      <div class="row">
        <div class="col-md-12">
          <div class="jumbotron">
            <h1>Welcome to My Blog!</h1>
            <p class="lead">Thank you so much for visiting. This is my test website built with Laravel. Please read my popular post!</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular Post</a></p>
            </div>
        </div>
      </div> <!-- end of header .row -->
      <div class="row">
        <div class="col-md-8">
          <div>
            <h3>Post Title</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat... </p>
            <a href="#" class="btn btn-primary">Read More</a>
          </div>
          <hr>
          <div>
            <h3>Post Title</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat... </p>
            <a href="#" class="btn btn-primary">Read More</a>
          </div>
          <hr>
          <div>
            <h3>Post Title</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat... </p>
            <a href="#" class="btn btn-primary">Read More</a>
          </div>
          <hr>
          <div>
            <h3>Post Title</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat... </p>
            <a href="#" class="btn btn-primary">Read More</a>
          </div>          
        </div>
        <div class="col-md-3 col-md-offset-1">
          <h2>Side Bar</h2>
        </div>
      </div>
@endsection   