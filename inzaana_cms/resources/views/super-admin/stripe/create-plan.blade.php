@extends('layouts.super-admin-master')
@section('title', 'Super Admin Dashboard')


@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left mediaCr">
            <div class="page-title titleEx">
                Inzaana
            </div>
            <div class="page-title hidden-xs">
                | Super Admin Dashboard</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="index.html">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Dashboard</li>
        </ol>
        <div class="clearfix">
        </div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->
    <!--BEGIN CONTENT-->
    <div class="page-content">
        <div id="tab-general">
            <div class="row">

                <div class="col-md-8 col-md-offset-2 stripe_plan">
                    @if(session('success'))
                        <p class="text-success">{{ session('success') }}</p>
                    @endif
                    <form class="form-horizontal" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">ID:</label>
                            <input type="text" class="form-control" value="{{old('plan_id')}}" name="plan_id" id="">
                            @if($errors->first('plan_id')) <p class="text-danger text-sm danger_text">{{ $errors->first('plan_id') }}</p> @endif
                        </div>
                        <div class="form-group">
                            <label for="">Name:</label>
                            <input type="text" class="form-control" value="{{old('plan_name')}}" name="plan_name" id="">
                            @if($errors->first('plan_name')) <p class="text-danger text-sm danger_text">{{ $errors->first('plan_name') }}</p> @endif
                        </div>
                        <div class="form-group">
                            <label for="">Currency:</label>
                            <select name="plan_currency" id="currency">
                                <option value="USD">USD</option>
                                <option value="BDT">Bangladesh</option>
                                <option value="AED">Arab Emirat</option>
                                <option value="BBD">Baharain</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Amount:</label>
                            <input type="text" class="form-control" value="{{old('plan_amount')}}" name="plan_amount" id="">
                            @if($errors->first('plan_amount')) <p class="text-danger text-sm danger_text">{{ $errors->first('plan_amount') }}</p> @endif
                        </div>
                        <div class="form-group">
                            <label for="">Interval:</label>
                            <select name="plan_interval" id="">
                                <option value="day">daily</option>
                                <option value="month">monthly</option>
                                <option value="year">yearly</option>
                                <option value="week">weekly</option>
                                <option value="3-month">every 3 months</option>
                                <option value="6-month">every 6 months</option>
                                <option value="custom">custom</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Trial period days:</label>
                            <input type="text" class="form-control" value="{{old('plan_trial')}}" name="plan_trial" id="">
                        </div>
                        <div class="form-group">
                            <label for="">Statement desc:</label>
                            <input type="text" class="form-control" value="{{old('plan_des')}}" name="plan_des" id="">
                            @if($errors->first('plan_des')) <p class="text-danger text-sm danger_text">{{ $errors->first('plan_des') }}</p> @endif
                        </div>
                        <input type="submit" class="btn btn-primary btn-sm" value="Create Plan">

                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--END CONTENT-->
@endsection