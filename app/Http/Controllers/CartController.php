<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Auth;
use App\User;
use App\Product;
use App\Order;
use App\Cart;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addToCart(Request $request, $id)
    {
            $product = Product::find($id);
        
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
                
            $cart->add($product, $product->id);
            
            $request->session()->put('cart',$cart);
          return redirect('/home/' .auth()->user()->id);                
         
    }

    public function ReducedByOne($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->reduceByOne($id);

        Session::put('cart', $cart);

        return redirect('/home/'. auth()->user()->id);
    }

    public function RemoveItem($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->removeItem($id);

        Session::put('cart', $cart);
        return redirect('home/'. auth()->user()->id);
    }
}
