<?php

namespace App\Http\Controllers;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\User;
use App\Product;
use App\Order;
use App\Cart;

class OrderController extends Controller
{

    public function __construct()
        {
            $this->middleware('auth');
        }
    
    public function orderList(User $user)
    {
        $orders = Auth::user()->orders;
        $orders->transform(function($order, $key) {
            $order->cart = unserialize($order->cart); 

            return $order;
        
        });
        return view('order.orderList',compact('orders', 'user'));
    }

    public function store_order()
    {
        $oldCart = Session::get('cart');

        $cart = new Cart($oldCart);

        $order = new Order();

        $order->cart = serialize($cart);


        auth()->user()->orders()->save($order);

        Session::forget('cart');

        return redirect('/home/' .auth()->user()->id);
    }
   
}
