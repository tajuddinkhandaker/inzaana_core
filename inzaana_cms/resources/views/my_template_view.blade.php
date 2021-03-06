@extends('layouts.admin-master') 
@section('title', 'Template View') 
@section('header-style')
 <link href="{{ URL::asset('css/view_template.css') }}" rel="stylesheet" type="text/css">  
@endsection
@section('breadcumb')
<h1>Template
<small>My Template View</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-cubes"></i> Home</a></li>
    <li>Template</li>
    <li class="active">My Template view</li>
</ol>
@endsection 

@section('content')

<div class="box box-info">
    <div class="box-header with-border text-center">
        <h1 class="box-title">My Templates ( {{ $templatesCount }} )</h1>
    </div>

    <div class="box-body">

        <div class="row"> 

            @if($templatesCount > 0)

                @foreach($savedTemplates as $template)
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="hovereffect">

                    <img class="img-responsive" src="{{ URL::asset('images/template/01.jpg') }}">
                    <div class="overlay">
                        <table id="parent" border="0">
                            <tr>
                                <td id="child" class="text-left"><h2>Price: Free </h2></td>
                                <td id="child" class="text-right"><h2><a class="btn-link" href="">More Info</a></h2></td>
                            </tr>
                        </table>

                        <a class="info btn btn-info btn-flat"
                            href="{{ route('user::templates.editor.edit', [ 'category' => $template->category_name, 'template' => $template->template_name, 'template_id' => $template->id ]) }}">Edit</a>
                        <a class="info btn btn-info btn-flat" 
                            href="{{ route('user::templates.viewer', [ 'saved_name' => str_slug($template->saved_name), 'template_id' => $template->id ]) }}">View</a>
                    </div>
                    <h4>{{ $template->saved_name }}</h4>
                </div>
                </div>
                @endforeach

            @else
                <div class="container">
                <div class="row">
                <div class="col-md-12 text-center">
                    <div class="alert alert-info">{!! $message !!}</div>
                </div>
                </div>
                </div>
            @endif

        </div>
        
    </div>

</div>

@endsection