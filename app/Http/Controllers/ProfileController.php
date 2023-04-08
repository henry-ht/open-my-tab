<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $response = [
            'status' => 'success',
            'data'    => false,
            'message' => '',
        ];

        $response['message'] = 'all data';
        $response['data'] = Auth::user();

        return response()->json($response, 200);
    }
}
