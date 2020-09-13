@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Product Lists</div>

                <div class="card-body">
                	<div class="row align-items-stretch">
	                	
		                	<div class="col-lg-4">
			                    <div class="card" style="width: 18rem;">
								  <img class="card-img-top" src="/storage/{{ $product->prod_image }}" height="200" width="200" alt="Card image cap">
								  <div class="card-body">								  	
								    <h5 class="card-title">{{ $product->prod_name }}</h5>							    
								    <div class="d-flex align-items-baseline">
									    <a href="#" class="btn btn-primary">Buy Now!</a>
									    <h5 class="card-title ml-auto p-1" style="color:#fc0e00; font-weight:bold;">(₱) {{ $product->prod_price }}.00</h5>
								    </div>
								  </div>
								</div>
							</div>
							<div class="col-lg-8">	
								<h2>Description</h2>
								<p class="card-text">{{ $product->prod_desc }}</p>
							</div>
							
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection	
