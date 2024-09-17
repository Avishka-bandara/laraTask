<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products =Product::orderby('id', 'desc')->get();
        $total = Product::count();
        return view('admin.product.home', compact('products', 'total'));

    }

    public function create()
    {
        return view('admin.product.create');
    
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'price' => 'required',
        ]);
        $data = Product::create($validation);

        if($data){
            session()->flash('success', 'Product added successfully');
            return redirect(route('admin/product'));
        }
        else{
            session()->flash('error', 'Product not added');
            return redirect(route('admin/product/create'));
        }
    }
    public function delete($id)
    {
        $products = Product::findOrFail($id);

        if($products->delete()){
            session()->flash('success', 'Product deleted successfully');
            return redirect()-> route('admin/product');
            
        }
        else{
            session()->flash('error', 'Product not deleted');
            return redirect()-> route('admin/product/');
        }
        
    }   

    public function edit($id)
    {
        $products = Product::findOrFail($id);
        return view('admin.product.update', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $products = Product::findOrFail($id);
        $title = $request->title;
        $category = $request->category;
        $price = $request->price;

        $products->title = $title;
        $products->category = $category;
        $products->price = $price;
        $data = $products->save();

        if($data){
            session()->flash('success', 'Product updated successfully');
            return redirect(route('admin/product'));
        }
        else{
            session()->flash('error', 'Product not updated');
            return redirect(route('admin/product/update'));
        }
    
    }


}
