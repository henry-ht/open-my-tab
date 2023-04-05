<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetRentRequest;
use App\Models\Rent;
use App\Http\Requests\StoreRentRequest;
use App\Http\Requests\UpdateRentRequest;
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
    public function store(StoreRentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Rent $rent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rent $rent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRentRequest $request, Rent $rent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rent $rent)
    {
        //
    }
}
