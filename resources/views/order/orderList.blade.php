@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
		
			<div class="card-header" style="background-color: white"><h4>Order Logs</h4></div> 
				@foreach ($orders as $order)
				<table class="table">
					  <thead>
					    <tr class="table-active">
					    	<th scope="col">Date</th>
					    	<th>{{ $order->updated_at }}</th>
							<th></th>
					    </tr>
					    <tr>
						    <th scope="col">Qty</th>
						    <th scope="col">Product Name</th>
						    <th scope="col">Price</th>					      
					    </tr>
					  </thead>
					  <tbody> 
						@foreach($order->cart->items as $item)
						<tr>	
							<td>{{ $item['qty'] }}</td>
							<td>{{$item['item']['prod_name']}}</td>
							<td>{{ $item['price']}}</td>	
						</tr>						
						@endforeach
						<tr>
							<td></td>
							<td></td>
							<td class="table-danger">Total Price:{{ $order->cart->totalPrice }}</td>	
						</tr>
					  </tbody>
					</table>
 
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection	