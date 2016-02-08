@extends('layouts.admin-master')
@section('title', 'Add Category')

@section('breadcumb')
<h1>Category
<small>Add Category</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-cubes"></i> Home</a></li>
    <li>Category</li>
    <li class="active">Add Category</li>
</ol>
@endsection

@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Add Category</h3>
    </div>
    
    <div class="box-body">
        <div class="row padTB"> 
            <!--form-->
            <form action="" method="GET">
                <div class="col-lg-6 col-lg-offset-3">
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <h4 class="boxed-header">Add your product category name.</h4>
                    </div>
                    <div class="box-body">
                    <div class="input-group">
                        <input id="search-box" name="search-box" type="text" class="form-control">
                        <span class="input-group-btn">
                          <button id="product-search-btn" class="btn btn-info btn-flat" type="submit"><i class="fa fa-lg fa-plus-square"></i>&ensp; Add Category</button>
                        </span>
                    </div>
                    </div>
                </div>
                </div>
            </form>
            <!--end of form-->
    </div>
</div>
    
    <!--recently added product-->
    <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Recently Added Category</h3>
                  <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table id="parent" class="table table-hover">
                    <tr>
                      <th class="text-center">ID</th>
                      <th class="text-center">Category Name</th>
                      <th class="text-center">Description</th>
                      <th class="text-center">Sub-categories</th>
                      <th class="text-center">Action</th>
                    </tr>
                    <tr>
                      <td class="text-center" id="child"><a href="">001</a> </td>
                      <td class="text-center" id="child"><a href="">Chocolate</a></td>
                      <td class="text-center" id="child"><a href="">This is a description</a></td>
                      <td class="text-center" id="child"><a href="">subcat-1, subcat-2, subcat-3</a></td>
                      <td class="text-center" id="child"><button id="product-search-btn" class="btn btn-info btn-flat btn-xs" type="submit">Edit</button> <button id="product-search-btn" class="btn btn-info btn-flat btn-xs" type="submit">Delete</button></td>
                    </tr>
                    <tr>
                      <td class="text-center" id="child"><a href="">002</a> </td>
                      <td class="text-center" id="child"><a href="">Fruit</a></td>
                      <td class="text-center" id="child"><a href="">This is a description</a></td>
                      <td class="text-center" id="child"><a href="">subcat-1, subcat-2,</a></td>
                      <td class="text-center" id="child"><button id="product-search-btn" class="btn btn-info btn-flat btn-xs" type="submit">Edit</button> <button id="product-search-btn" class="btn btn-info btn-flat btn-xs" type="submit">Delete</button></td>
                    </tr>
                    <tr>
                     <td class="text-center" id="child"><a href="">003</a> </td>
                      <td class="text-center" id="child"><a href="">Drinks</a></td>
                      <td class="text-center" id="child"><a href="">This is a description</a></td>
                      <td class="text-center" id="child"><a href="">subcat-1, subcat-2, subcat-3 </a></td>
                      <td class="text-center" id="child"><button id="product-search-btn" class="btn btn-info btn-flat btn-xs" type="submit">Edit</button> <button id="product-search-btn" class="btn btn-info btn-flat btn-xs" type="submit">Delete</button></td>
                    </tr>
                    <tr>
                     <td class="text-center" id="child"><a href="">004</a> </td>
                      <td class="text-center" id="child"><a href="">Foods</a></td>
                      <td class="text-center" id="child"><a href="">This is a description</a></td>
                      <td class="text-center" id="child"><a href="">subcat-1, subcat-2,</a></td>
                      <td class="text-center" id="child"><button id="product-search-btn" class="btn btn-info btn-flat btn-xs" type="submit">Edit</button> <button id="product-search-btn" class="btn btn-info btn-flat btn-xs" type="submit">Delete</button></td>
                    </tr>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
    <!--end of recently added product-->

@endsection