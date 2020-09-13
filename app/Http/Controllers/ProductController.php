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


class ProductController extends Controller
{
    public function __construct()
        {
            $this->middleware('auth');
        }
   
    public function index(User $user)
    {

        if (!Session::has('cart')){
            return view('product.index',compact('user'));
        }
        $oldCart = Session::get('cart');

        $cart = new Cart($oldCart);

        $products = $cart->items;
        $totalPrice = $cart->totalPrice;
        $totalQty = $cart->totalQty;

        return view('product.index', compact('products', 'totalPrice', 'user', 'totalQty'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store()
    {
        $data = request()->validate([
            'prod_name' => 'required',
            'prod_price' => 'required',
            'prod_qty' => 'required',
            'prod_desc' => 'required',
            'prod_image' => '',
        ]);
        $imagePath = request('prod_image')->store('uploads', 'public');

        auth()->user()->products()->create([
            'prod_name' => $data['prod_name'],
            'prod_price' =>  $data['prod_price'],
            'prod_qty' =>  $data['prod_qty'],
            'prod_desc' =>  $data['prod_desc'],
            'prod_image' => $imagePath,
        ]);

        return redirect('/home/' .auth()->user()->id);
    }

    public function show(Product $product)
    {
       return view('product.show', compact('product'));
    }

    public function edit(Product $product)
    {

        return view('product.edit',compact('product'));
    }

    public function update(Product $product)
    {
        $data = request()->validate([
            'prod_name' => 'required',
            'prod_price' => 'required',
            'prod_qty' => 'required',
            'prod_desc' => 'required',
            'prod_image' => '',
        ]);

        $product->update($data);
        return redirect('/product/prodList/' .auth()->user()->id);
    }

    public function ReducedByOne($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->reduceByOne($id);

        Session::put('cart', $cart);

        return redirect('/home/'. auth()->user()->id);
    }

    public function destroy($id)
    {
       $delete = Product::find($id);
       
       $delete->delete();

       return redirect('/product/prodList/' .auth()->user()->id);
    }

    public function prodList(User $user)
    {
        return view('product.prodList',compact('user'));
    }
   
}
