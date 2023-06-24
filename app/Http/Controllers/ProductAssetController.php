<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApplicationResource;
use App\Models\ProductAssets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assets = ProductAssets::all();

        return new ApplicationResource(true, 'list assets data', $assets->load('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer',
            'image' => 'required|image|mimes:png,jpg|max:1024'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = $request->file('image');
        $fileName = $image->getClientOriginalName();
        $image->storeAs('public/product_assets', $fileName);

        $asset = ProductAssets::create([
            'product_id' => $request->product_id,
            'image' => $image->getClientOriginalName()
        ]);

        return new ApplicationResource(true, 'assets uploaded', $asset->load('product'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductAssets $asset)
    {
        return new ApplicationResource(true, 'assets data found', $asset->load('product'));
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
    public function destroy(ProductAssets $asset)
    {
        Storage::delete('public/product_assets/'.$asset->image);

        $asset->delete();

        return new ApplicationResource(true, 'assets deleted', null);
    }
}
