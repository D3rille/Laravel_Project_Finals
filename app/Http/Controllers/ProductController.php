<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Crop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // Get the currently authenticated user's ID
         $userId = Auth::id();

         // Retrieve products for the logged-in user
         $crops = Product::select('crops.crop_id','crops.name','products.id', 'products.price', 'products.quantity', 'products.created_at')
             ->join('crops', 'products.crop_id', '=', 'crops.crop_id')
             ->where('products.user_id', $userId)
             ->orderByDesc('products.created_at')
             ->get();

        // $allCrops = Crop::all();
        $cropOptions = Crop::pluck('name', 'crop_id');

        //  // Create an array of objects with 'name' as values and 'crop_id' as keys
        // $options = $allCrops->mapWithKeys(function ($crop) {
        //     return [$crop->crop_id => $crop->name];
        // });


         return view("cropSalesTracker", ['data' => $crops, 'options' => $cropOptions]);
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
        // Validate the request data
        $request->validate([
            'crop_id' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        // Get the currently authenticated user's ID
        $userId = auth()->id();

        // Create a new product
        $newProduct = Product::create([
            'crop_id' => $request->input('crop_id'),
            'user_id' => $userId,
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            // Add other fields as needed
        ]);

        // Redirect to a specific route or page
        return redirect()->route('salesTracker')->with('success', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
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
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the product by ID
        $product = Product::find($id);

        // Check if the product exists
        if (!$product) {
            // Handle the case where the product is not found
            return redirect()->route('salesTracker')->with('error', 'Product not found');
        }

        // Check if the logged-in user owns the product
        if (Auth::id() !== $product->user_id) {
            // Handle the case where the user is not authorized to delete the product
            return redirect()->route('salesTracker')->with('error', 'Unauthorized to delete this product');
        }

        // Delete the product
        $product->delete();

        // Redirect with a success message
        return redirect()->route('salesTracker')->with('success', 'Product deleted successfully');
    }
}
