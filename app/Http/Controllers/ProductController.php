<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Db;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = DB::select('SELECT * FROM `categories` WHERE status = "Active" ');
        $products = DB::select('SELECT products.id, title, name, price, quantity, categoryId, products.status, products.image FROM products JOIN categories ON categories.id = products.categoryId;');
        return view('pages.admin.product', compact('categories', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = uniqid();
        $name = $request->productName;
        $price = $request->productPrice;
        $quantity = $request->productQty;
        $category = $request->productCat;
        $image = time() . '.' . $request->image->extension();

        $request->image->move(public_path('assets/products'), $image);

        DB::select("INSERT INTO `products`(`id`, `title`, `price`, `quantity`, `categoryId`, `status`, `created_at`)
        VALUES ('".$id."', '".$name."',' ".$price."', '".$quantity."', '".$category."', 'Active', NOW() )");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = DB::select("SELECT products.id, title, name, price, quantity, categoryId, products.status FROM products JOIN categories ON categories.id = products.categoryId WHERE products.id = '".$id."';");
        return $data;
    }    
        
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
