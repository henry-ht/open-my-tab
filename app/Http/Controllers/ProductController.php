<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetProductRequest;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetProductRequest $request)
    {
        $response = [
            'status' => 'success',
            'data'    => false,
            'message' => '',
        ];

        $filters = $request->only([
            'category_id',
            'product_id'
        ]);

        $products = Product::query();

        if(!empty($filters['category_id'])){
            $products = $products->where('category_id', $filters['category_id']);
        }

        $response['message'] = 'all data';
        $response['data'] = $products->get();

        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $response = [
            'status' => 'success',
            'data'    => false,
            'message' => '',
        ];

        $credentials = $request->only([
            'category_id',
            'name',
            'price'
        ]);

        try {
            $product->fill($credentials)->save();

            $response['message'] = 'product updated';
            $response['data'] = $credentials;

            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response['message'] = $th->getMessage();
            $response['status'] = 'warning';

            return response()->json($response, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $response = [
            'status' => 'success',
            'data'    => false,
            'message' => '',
        ];

        $credentials = $request->only([
            'category_id',
            'name',
            'price'
        ]);

        try {
            $data = Product::create($credentials);

            $response['message'] = 'product created';
            $response['data'] = $data;

            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response['message'] = $th->getMessage();
            $response['status'] = 'warning';

            return response()->json($response, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $response = [
            'status' => 'success',
            'data'    => false,
            'message' => '',
        ];

        $response['message'] = 'product deleted';
        $response['data'] = $product->delete();
        return response()->json($response, 200);
    }

    /**
     * restore the specified resource from storage.
     */
    public function restore(Product $product)
    {
        $response = [
            'status' => 'success',
            'data'    => false,
            'message' => '',
        ];

        if($product->trashed()){
            $response['message'] = 'product restored';
            $response['data'] = $product->restore();
            return response()->json($response, 200);
        }else{
            $response['message'] = 'product was not restored';
            $response['status'] = 'warning';
            $response['data'] = false;
            return response()->json($response, 500);
        }

    }
}
