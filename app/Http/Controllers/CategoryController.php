<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = [
            'status' => 'success',
            'data'    => false,
            'message' => '',
        ];

        $categories = Category::query();

        $response['message'] = 'all data';
        $response['data'] = $categories->get();

        return response()->json($response, 200);
    }
}
