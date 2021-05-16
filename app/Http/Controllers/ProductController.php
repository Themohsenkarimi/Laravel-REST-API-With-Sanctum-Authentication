<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct(){
        
        $this->middleware("auth:sanctum",["except"=>["index","show"]]);
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::all();
        return response()->json([
            "success"=> true,
            "products"=>$products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
        "title"=>"required",
        "description"=>"required",
        "price"=>"required",
       ]);

       $product=Product::create([
        "title"=>$request->title,
        "description"=>$request->description,
        "price"=>$request->price,
       ]);

       return response()->json([
           "success"=>true,
           "product"=>$product,
       ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $product=Product::find($id);
       return response()->json([
        "success"=>true,
        "product"=>$product,
       ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $product=Product::find($id);

        $product->update($request->all());

        return response()->json([
            "success"=>true,
            "product"=>$product,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();

        return response()->json([
            "success"=>true,
            "message"=>"the product has been deleted!",
        ]);

    }
}
