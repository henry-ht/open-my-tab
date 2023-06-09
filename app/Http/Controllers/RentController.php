<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Http\Requests\GetRentRequest;
use App\Models\Rent;
use App\Http\Requests\StoreRentRequest;
use App\Http\Requests\UpdateRentRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetRentRequest $request)
    {
        $response = [
            'status' => 'success',
            'data'    => false,
            'message' => '',
        ];

        $filters = $request->only([
            'start_date',
            'end_date',
            'product_id',
            'status'
        ]);

        if(Gate::allows('is_admin')){
            $rents = Rent::query();
        }else{
            $rents = Rent::where('user_id', Auth::user()->id);
        }

        $rents = $rents->with('productRent')->withSum('productRent', 'price');

        if(!empty($filters['start_date']) && !empty($filters['end_date'])){
            $rents = $rents->where('start_date', '>=', $filters['start_date']." 00:00:00")
                            ->where('end_date', '<=', $filters['end_date']." 23:59:59");
        }

        if(!empty($filters['status'])){
            $rents = $rents->where('status', $filters['status']);
        }

        if(!empty($filters['product_id'])){
            $rents = $rents->whereHas('productRent', function ($q) use($filters){
                return $q->where('product_id', $filters['product_id']);
            });
        }

        $response['message'] = 'all data';
        $response['data'] = $rents->get();

        return response()->json($response, 200);
    }

    public function prin(){

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRentRequest $request)
    {
        $response = [
            'status' => 'success',
            'data'    => false,
            'message' => '',
        ];

        $credentials = $request->only([
            'product_ids',
            'payment_method',
            'start_date',
            'end_date'
        ]);

        try {
            $reference = Str::random(10);

            while (!empty(Rent::where("reference", $reference)->first())) {
                $reference = Str::random(10);
            }

            $productIds = $credentials['product_ids'];
            $credentials['reference'] = $reference;
            $credentials['user_id'] = Auth::user()->id;
            $credentials['payment_method'] = json_encode($credentials['payment_method']);
            unset($credentials['product_ids']);

            $newRent = Rent::create($credentials);
            $total = 0;

            foreach ($productIds as $key => $value) {
                $product = Product::where('id', $value)->first();
                $total = $total + $product->price;
                $newRent->products()->attach($value, [
                    'name'          => $product->name,
                    'price'         => $product->price,
                    'quantity'      => $product->quantity,
                    'category_id'   => $product->category_id,
                ]);
            }

            $response['message'] = 'rent created';
            $response['data'] = $newRent->load('productRent')->loadSum('productRent', 'price');

            return response()->json($response, 200);
        } catch (\Throwable $th) {
            // $response['message'] = 'oops, something is not right'; //$th->getMessage()
            $response['message'] = $th->getMessage();
            $response['status'] = 'warning';

            return response()->json($response, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRentRequest $request, Rent $rent)
    {
        $response = [
            'status' => 'success',
            'data'    => false,
            'message' => '',
        ];

        $credentials = $request->only([
            'status',
        ]);

        try {
            $rent->fill($credentials)->save();

            $response['message'] = 'rent updated';
            $response['data'] = $rent;

            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response['message'] = 'oops, something is not right'; //$th->getMessage()
            $response['status'] = 'warning';

            return response()->json($response, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rent $rent)
    {
        $response = [
            'status' => 'success',
            'data'    => false,
            'message' => '',
        ];

        $response['message'] = 'product deleted';
        $response['data'] = $rent->delete();
        return response()->json($response, 200);
    }
}
