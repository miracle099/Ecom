<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //

    public function admin_dashboard()
    {
        return view('admin.index');
    }


    //function for CATEGORY
    public function category()
    {
        $categories = category::orderBy('created_at', 'DESC')->paginate(3);
        return view('admin.category', compact('categories'));
    }

    public function add_category(Request $request)
    {
        //VALIDATION OF USER INPUTS
        $validator = $request->validate([
            'category' => 'required|unique:categories,category',
            

        ],[
            //CUSTOMIZED ERROR MESSGAGE
            'category.unique' => 'This category already exists',
        ]);

        Category::create($validator);
        
        return redirect()->back()->with('success', 'Category added successfully');

        
        
    }

    public function deleteCategory($id) {
        $data = Category::find($id);
        $data->delete();
        return redirect()->back()->with('succes', 'category deleted successfully');
    }

    public function createProduct(){
            return view('admin.createProduct');
    }


    public function addProduct(Request $request)
    {
        $request->validate([
            'productName'=> 'required|max:225',
            'productCategory' => 'required|max:225',
            'productImage' => ['nullable', 'file', 'max:10000'],
            'productDescription' => 'required',
            'manufacturerName' => 'required|max:225',
            'status' => 'required',
            'productPrice' => 'required',
            'quantity' => 'nullable|max:225',
            'warranty' => 'nullable|max:225',
            'discountPrice' => 'nullable',
            
        ]);
        
        $product = new Product();
        $product->productName = $request->productName;
        $product->productCategory = $request->productCategory;
        $product->productDescription = $request->productDescription;
        $product->manufacturerName = $request->manufacturerName;
        $product->productPrice = $request->productPrice;
        $product->discountPrice = $request->discountPrice;
        $product->quantity = $request->quantity;
        $product->status = $request->status;
        $product->featuredProduct = $request->featuredProduct;

        if ($request-> hasFile('productImage')) {
            $image = $request->file('productImage');
            $productImage = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('productFolder'), $productImage);
            $product->productImage = $productImage;
        }

        $product->save();
        return redirect()->back()->with('message', 'product added successfully');

    }


    public function products(){
        return view('admin/products');
    }


    // function to editing product
    public function editProduct($productId){
        $product = Product::findorFail($productId);
        return view('admin.editProduct', compact('product'));
    }


    // functiont to delete product
    public function deleteProduct($id) {
        $data = Product::find($id);
        $data->delete();
        return redirect()->back()->with('succes', 'product deleted successfully');
    }


    // function to update products
    public function updateProduct(Request $request, $id) {
        $request->validate([
            'productName'=> 'required|max:225',
            'productCategory' => 'required|max:225',
            'productImage' => ['nullable', 'file', 'max:10000'],
            'productDescription' => 'required',
            'manufacturerName' => 'required|max:225',
            'status' => 'required',
            'productPrice' => 'required',
            'quantity' => 'nullable|max:225',
            'warranty' => 'nullable|max:225',
            'discountPrice' => 'nullable',
            
        ]);
        
        $product = Product::find($id);
        $product->productName = $request->productName;
        $product->productCategory = $request->productCategory;
        $product->productDescription = $request->productDescription;
        $product->manufacturerName = $request->manufacturerName;
        $product->productPrice = $request->productPrice;
        $product->discountPrice = $request->discountPrice;
        $product->quantity = $request->quantity;
        $product->status = $request->status;
        $product->featuredProduct = $request->featuredProduct;

        if ($request-> hasFile('productImage')) {
            $image = $request->file('productImage');
            $productImage = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('productFolder'), $productImage);
            $product->productImage = $productImage;
        }

        $product->save();
        return redirect()->route('products')->with('message', 'product added successfully');

    }
}
