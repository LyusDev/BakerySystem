@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Product</div>

                <div class="card-body">
                    <form method="POST" action="/product/{{ $product->id }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                    <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label for="prod_name" class="col-md-4 col-form-label text-md-right">Product Name</label>

                            <div class="col-md-6">
                                <input id="prod_name" type="text" class="form-control @error('prod_name') is-invalid @enderror" name="prod_name" value="{{ old('prod_name') ?? $product->prod_name}}" required autocomplete="prod_name" autofocus>

                                @error('prod_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="prod_price" class="col-md-4 col-form-label text-md-right">Product Price</label>

                            <div class="col-md-6">
                                <input id="prod_price" type="text" class="form-control @error('prod_price') is-invalid @enderror" name="prod_price" value="{{ old('prod_price') ?? $product->prod_price }}" required autocomplete="prod_price" autofocus>

                                @error('prod_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="prod_qty" class="col-md-4 col-form-label text-md-right">Product Quantity</label>

                            <div class="col-md-6">
                                <input id="prod_qty" type="text" class="form-control @error('prod_qty') is-invalid @enderror" name="prod_qty" value="{{ old('prod_qty') ?? $product->prod_qty }}" required autocomplete="prod_qty" autofocus>

                                @error('prod_qty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                          <div class="form-group row">
                            
                            <label for="prod_image" class="col-md-4 col-form-label text-md-right">Product Image</label>

                            <div class="col-md-6">
                              <img src="/storage/{{ $product->prod_image }}" height="100" width="100" class="pb-2">
                              <input type="file" class="form-control-file" id="prod_image" name="prod_image">


                              @error('prod_image')
                                  
                                      <strong>{{ $message }}</strong>
                                  
                              @enderror
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                            <label for="prod_desc" class="col-md-4 col-form-label text-md-right">Product Description</label>

                            <div class="col-md-12">                            
                                <textarea rows="8" class="form-control @error('prod_desc') is-invalid @enderror" name="prod_desc" value="" required autocomplete="prod_desc" autofocus id="prod_desc">{{ old('prod_desc') ?? $product->prod_desc }}</textarea>

                                @error('prod_desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4 d-flex">
                                <button type="submit" class="btn btn-primary mr-1">
                                    Save
                                </button>
                                <a href="/home/{{ Auth::user()->id }}">
                                    <buttonn class="btn btn-danger">
                                        Cancel
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection