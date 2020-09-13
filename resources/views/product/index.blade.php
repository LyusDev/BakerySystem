@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">

				<div class="card-body">
					<div class="row">
						<div class="col-lg-8">
							<h1>Product List </h1>
						
							<div class="row">
								@foreach ($user->products as $product)
								<div class="col-lg-4 pt-4">
									<div class="card" style="width: 15rem;">
										<a href="/product/{{$product->id}}">
											<img class="card-img-top" src="/storage/{{ $product->prod_image }}" height="200" width="200" alt="Card image cap">
										</a>
										<div class="card-body">
											<h5 class="card-title">{{ $product->prod_name }}</h5>

											<p class="card-text desc" style="width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $product->prod_desc}}</p>
											<div class="d-flex align-items-baseline">

												<a href="/add-to-cart/{{$product->id}}">

													<button class="btn btn-primary">Add to Cart</button>
												</a>

												<h5 class="card-title ml-auto p-1" style="color:#fc0e00; font-weight:bold;">(₱) {{ $product->prod_price}}.00</h5>
											</div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
						<div class="col-lg-4">
							<div class="card-body">
								<div class="col-lg-4">
									@if(Session::has('cart'))
									<div class="card" style="width: 18rem;">
										<div class="card-body">
											<form method="POST" action="/order" enctype="multipart/form-data">
												@csrf

												<h5 class="card-title">Add to Cart</h5>
												<div class="table-wrapper-scroll-y my-custom-scrollbar">
													<table class="table mb-0">
														<thead>
															<tr>
																<th scope="col">Qty</th>
																<th scope="col">Item</th>
																<th scope="col">Cost</th>
																<th></th>
															</tr>
														</thead>
														<tbody>
															@foreach($products as $product)
															<tr>
																<th scope="row">{{ $product['qty'] }}</th>
																<td>{{ $product['item']['prod_name'] }}</td>
																<td>{{ $product['price']}}</td>
																<td>
																	<div class="btn-group"><button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
																		<ul class="dropdown-menu">
																			<li>
																				<a href="/reduced-by-one/{{ $product['item']['id'] }}">Reduce by 1</a>
																			</li>
																			<li>
																				<a href="/remove-item/{{ $product['item']['id'] }}">Remove Item</a>
																			</li>
																		</ul>
																	</div>
																</td>
															</tr>
															@endforeach
														</tbody>
													</table>
												</div>
												<div class="d-flex align-items-baseline">
													<h5 class="card-title">Total</h5>

												</div>
												<div class="d-flex align-items-baseline">
													<h5 class="card-title mr-auto p-1" style="color:#fc0e00; font-weight:bold;"> Qty. {{ $totalQty }}</h5>
													<h5 id="totalPayment" class="card-title ml-auto p-1" style="color:#fc0e00; font-weight:bold;">{{ $totalPrice }}</h5>
												</div>
												<div class="d-flex align-items-baseline mb-3">
													<a href="/order/" type="button" class="btn btn-success">Cash Payment</a>

												</div>
												<a href="/order/">
												<div id="paypal-button-container"></div>
												</a>
												@else
											</form>
											<div class="card" style="width: 18rem;">
												<div class="card-body">
													<h5 class="card-title">Add to Cart</h5>
													<div class="table-wrapper-scroll-y my-custom-scrollbar">
														<table class="table mb-0">
															<thead>
																<tr>
																	<th scope="col">Quantity</th>
																	<th scope="col">Item</th>
																	<th scope="col">Cost</th>
																	<th></th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>No Items in Cart!</td>
																	<td></td>
																	<td></td>
																</tr>
															</tbody>
														</table>
													</div>
													<div class="d-flex align-items-baseline">
														<h5 class="card-title">Total</h5>
														<h5 class="card-title ml-auto p-1" style="color:#fc0e00; font-weight:bold;">(₱) 0.00</h5>
													</div>
													<div class="d-flex align-items-baseline mb-3">
														<a href="#" type="button" class="btn btn-success">Check Out</a>
													</div>

													@endif
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
        <script>	
            paypal.Buttons({
                createOrder: function(data, actions) {
                    // This function sets up the details of the transaction, including the amount and line item details.
					
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: document.getElementById('totalPayment').innerHTML
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    // This function captures the funds from the transaction.
                    return actions.order.capture().then(function(details) {
                        // This function shows a transaction success message to your buyer.
                        alert('Transaction completed by ' + details.payer.name.given_name);
						window.location.href = "/order";
                    });
                }
            }).render('#paypal-button-container');
            //This function displays Smart Payment Buttons on your web page.
        </script>
		@endsection