<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //We are using request because we are getting data from user
    public function store(Request $request)
    {
        //VALIDATION OF USER INPUTS
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|string|unique:users,email|max:255,string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'password' => 'required|min:5|max:40',
            'confirm_password' => 'required|min:5|max:40|same:password',

        ]);

        //IF FORM/VALIDATION FAILS RETURN BACK WITH ERROR MSG
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //PUSHING USER INPUTS TO DATABASE ONCE SUCCESSFUL
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $save = $user->save();
        if($save){
            return redirect()->route('home')->with('message', 'Registration Successful');
        } else {
            return redirect()->back()->with('error', 'Registration failed');
        }

    }

    //LOGOUT
    public function user_logout()
    {
        Auth::guard('web')->logout(); //LOGOUT IS LARAVEL KEYWORD FOR LOGOUT
        return redirect('/')->with('message', 'You have successfully logged out');
    }

    public function product_details($id)
    {
        $data = Product::findorFail($id);

        
        $getId = $data->id;
        $getCatategory = $data->productCategory;


        $similar = Product::where('productCategory', $getCatategory)
        ->where('id', '!=', $getId)
        ->latest()->paginate(8);
        return view('product_details', compact('data', 'similar'));
    }
    
    public function addToCart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();

            $product = Product::findorFail($id);
            // dd($product);
            $cart = new Cart();
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->userId = $user->id;
            $cart->productId = $product->id;
            $cart->productName = $product->productName;
            if($product->discountPrice != null){
                $cart->unitPrice = $product->discountPrice;
                $cart->totalPrice = $product->discountPrice * $request->quantity;
            } else {
                $cart->unitPrice = $product->productPrice;
                $cart->totalPrice = $product->productPrice * $request->quantity;
            }

            if ($product->quantity < $request->quantity) {
                return redirect()->back()->with('error', 'this quantity you entered is more than the quantity available');
            } else {
                $cart->productQuantity = $request->quantity;
                $cart->productImage = $product->productImage;
                $cart->save();
            }
            return redirect()->back()->with('message', 'product added to cart succesfully');
        } else {
            return redirect('login');
        }
    }

    public function carts ()
    {
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $carts = Cart::where('userId', $userId)->get();
           return view('carts', compact('carts'));
        }else {
            return redirect('login');
        }
    }

    public function payOndelivery()
     {
        return view('payOndelivery');
    }

     // functiont to delete product
     public function deleteCart($id)
      {
        $data = Cart::find($id);
        $data->delete();
        return redirect()->back()->with('succes', 'product deleted successfully');
    }

    public function proceedDelivery(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'address' => 'required | string',
            'phone' => 'required | string',
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (Auth::user()) {
        $user = Auth::user();
        $authUserId = $user->id;
        $datas = Cart::where('userId', $authUserId)->get();

        foreach($datas as $data){
            $order = new Order();
            $order->name = $data->name;
            $order->email = $data->email;
            $order->address = $request->address;
            $order->phone = $request->phone;
            $order->productName = $data->productName;
            $order->productImage = $data->productImage;
            $order->unitPrice = $data->unitePrice;
            $order->totalPrice = $data->totalPrice;
            $order->productQuantity = $data->productQuantity;
            $order->productId = $data->productId;
            $order->userId = $authUserId;
            $order->paymentStatus = "Cash on Delivery";
            $order->deliveryStatus = "Processing";

            $save = $order->save();

            $cartId = $data->id;
            $cart = Cart::findorFail($cartId);
            $cart->delete();
        }if ($save) {
            return redirect()->route('carts')->with('message', 'Order Placed Successfully, Wait for approval');
        }
        } else {
            return redirect('lodin');
        }
    }


    public function productCategory($id){
        $categories = Category::all();

        $catId = Category::findorFail($id);

        $catName = $catId->category;

        $productCategories = Product::where('productCategory', $catName)->get();

        $productCount = Product::where('productCategory', $catName)->count();

        return view('productCategory', compact('productCategories', 'catName', 'productCount'));
    }
 
}
