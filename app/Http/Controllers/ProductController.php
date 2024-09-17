<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.home');

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

}
