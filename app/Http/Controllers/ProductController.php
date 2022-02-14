<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Rules\ProductNameUppercase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;

class ProductController extends Controller
{
    public function index()
    {
        
        
         /// policy check
        // $response = Gate::inspect('viewAny');
               
        // if($response->allowed()){

            $products = Product::all();

            return $products;
        // }

        // return response(['Message' => $response->message()]);
            
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
        /// policy check
        //Gate::authorize('update');
        $response = Gate::inspect('update');

        if($response->allowed()){

            $product->update($request->all());

            return $product;
        }

        return response(['Message' => $response->message()],401);
        
    }

    public function destroy(Product $product)
    {
        $response = Gate::inspect('delete',$product);

        if($response->allowed()){

            $product->delete();
            //$product = Product::destroy($id);
            return response([
                'Message' => 'Deleted successfully'
            ]);
        }
        

        return response(['Message' => $response->message()],401);
    }


    public function search($name)
    {
        return Product::where('name','like','%'.$name.'%')->get();
    }
}
