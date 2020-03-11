@extends('admin.layouts.app')

@section('content_header')
    <div class="row mb-2">
      <div class="col-sm-6">
          <h1 class="m-0 text-dark">Product</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"> <a href="{{ route('product.index') }}">Product</a></li>
            <li class="breadcrumb-item active">{{$product->title}}</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
@endsection('content_header')

@section('content_body')

    <div class="row">
      <section class="col-md-12 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas mr-1"></i>
                  Product Details
                </h3>
                
              </div><!-- /.card-header -->

              <div class="card-body">
                <div class="tab-content p-0">
                  
                  <!-- Main card content.. -->
                  
                  <div class="">
                    <div class="container">
                        <div class="form-group">
                            <strong>Title: </strong>
                            {{ $product->title}}
                        </div>
                    </div>
                    <div class="container">
                        <div class="form-group">
                            <strong>Description: </strong>
                            {{ $product->long_desc}}
                        </div>
                    </div>
                    <div class="container">
                        <div class="form-group">
                            <strong>Unit: </strong>
                            {{ $product->unit->name}}
                        </div>
                    </div>
                    <div class="container">
                        <div class="form-group">
                            <strong>Price: </strong>
                            {{ $product->price}}
                        </div>
                    </div>
                    <div class="container">
                        <div class="form-group">
                            <strong>Status: </strong>
                            {{ $product->status}}
                        </div>
                    </div>
                  </div>

                  <!-- /.Main card-content.. -->
       
                </div>
              </div><!-- /.card-body -->

        </div>
        <!-- /.card -->
      </section>
    </div>
    

@endsection('content_body')