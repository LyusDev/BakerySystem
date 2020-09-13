@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
			<div class="card-header" style="background-color: white"><h4>Product Management</h4></div> 

                <div class="card-body">
                    <table class="table">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Name</th>
					      <th scope="col">Price</th>
					      <th scope="col">Quantity</th>
					      <th scope="col">Description</th>
					      <th scope="col">Image</th>
					      <th scope="col">Action</th>
					    </tr>
					  </thead>
					  <tbody> 

					  	@foreach ($user->products as $product)
					    <tr>
					      <th scope="row">{{ $product->id }}</th>
					      <td>{{ $product->prod_name }}</td>
					      <td>(₱){{ $product->prod_price }}.00 pesos</td>
					      <td>{{ $product->prod_qty }}</td>
					      <td>{{ $product->prod_desc }}</td>
					      <td><img src="/storage/{{ $product->prod_image }}" height="100" width="100"></td>
					      <td><a href="/product/{{ $product->id }}/edit"><input type="button" name="" class="btn btn-primary" value="edit"></a></td>
						  <td>
						  	<form method="post" class="delete_form" action="{{action('ProductController@destroy', $product['id'])}}">
								{{csrf_field()}}
								<input type="hidden" name="_method" value="DELETE">
								<button class="btn btn-danger">Delete</button>
							</form>
						  </td>
						</tr>
					    @endforeach
					  </tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection	