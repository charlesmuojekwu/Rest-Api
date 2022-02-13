<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Rules\ProductNameUppercase;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return $products;
    }

    public function store(Request $request)
    {   
       $request->validate([
           'name' => ['required',new ProductNameUppercase],
           'slug' => 'required',
           'price' => 'required'
       ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->slug);

        return Product::create($data);

        // return Product::create([
        //     'name' => 'Product-one',
        //     'slug' => Str::slug('product-one'),
        //     'description' => 'The product one',
        //     'price' => '99.99'
        // ]);
    }

    ### model binding approach

    public function show(Product $product)
    {
        return $product;
    }


    public function update(Product $product,Request $request)
    {
        $product->update($request->all());

        return $product;
    }

    public function destroy(Product $product)
    {
        $product->delete();
        //$product = Product::destroy($id);

        return $product;
    }


    public function search($name)
    {
        return Product::where('name','like','%'.$name.'%')->get();
    }
}
