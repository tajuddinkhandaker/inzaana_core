@extends('layouts.master_out')

@section('title', 'Log-In')

@section('header-style')
 <link href="{{ URL::asset('css/signIn.css') }}" rel="stylesheet" type="text/css">  
@endsection

@section('content')
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-6 firstpart animatedParent animateOnce" >
         <div class="row" style="margin-top:100px">
      <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-2 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading text-center panHead">
           <h2 class="CustomHead animated fadeInLeftShort" ><i class="fa fa-sign-in"></i> Login Here</h2>
          </div>
          <div class="panel-body pad50">

            <!-- ============================== LOG IN FORM ================================= -->
            <form role="form" method="POST" action="{{ url('/login') }}">
              
              {!! csrf_field() !!}

              <fieldset>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} animated fadeInLeftShort">
                  <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" value="{{ old('email') }}">
                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} animated fadeInLeftShort">
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                  @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
                </div>
                <span class="button-checkbox animated fadeInLeftShort">
                    <button type="button" class="btn" data-color="info">Remember Me</button>
                    <input type="checkbox" name="remember" id="remember" checked="checked" class="hidden">
                    <a href="{{ url('/password/reset') }}" class="btn btn-link pull-right animated fadeInLeftShort">Forgot Password?</a>
        				</span>
                <hr class="mar30">
                <div class="row">
                   <div class="col-xs-12 col-md-6 col-md-offset-3 animated growIn">
                    <!-- <a href="#" class="btn btn-lg btn-info btn-block">Log In</a> -->
                    <button type="submit" class="btn btn-lg btn-info btn-block">Log In</button>
                  </div>
                </div>
              </fieldset>
          </form>
          <!-- =============================================================================== -->

          </div>
        </div>
      </div>
    </div>
      </div>
      
      <div class="col-md-6 backgroundWhite animatedParent animateOnce">
        <div class="row">
          <div class="col-xs-12 col-md-8 col-md-offset-2 marTop100 text-center">
            <img class="img-responsive animated fadeInRightShort" src="{{ URL::asset('images/signInResponsive.png') }}">
            <h1 class="text-center pad30 animated fadeInRightShort CustomHead">Inzaana <small>Simply Business!</small></h1>
            <p class="text-center animated fadeInRightShort paraDeco">Choose your Business Website from our thousands of free Responsive Template!</p>
           <label class="padDown animated growIn">Dont have any account yet?<a href="/" class="btn btn-link">Create your own store!</a></label>
          </div>
        </div>
      </div>

    </div>

  </div>
@endsection

@section('footer-script')
  <script src="{{ URL::asset('js/signIn.js') }}"></script>
@endsection
