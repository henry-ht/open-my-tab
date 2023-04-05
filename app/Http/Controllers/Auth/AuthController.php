<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostLoginRequest;
use App\Http\Requests\PostRegisterRequest;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(PostLoginRequest $request)
    {
        $response = [
            'status' => 'success',
            'data'    => false,
            'message' => '',
        ];

        $credentials = $request->only([
            'email',
            'password'
        ]);

        if(Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;

            $response['data'] = $success;
            $response['message'] = 'User login successfully.';

            return response()->json($response, 200);
        }
        else{
            $response['message'] = 'Unauthorised';
            $response['status'] = 'warning';
            return response()->json($response, 404);
        }
    }

    public function register(PostRegisterRequest $request){
        $response = [
            'status' => 'success',
            'data'    => false,
            'message' => '',
        ];

        $credentials = $request->only([
            'name',
            'email',
            'password'
        ]);

        try {
            User::create([
                'name' => $credentials['name'],
                'email' => $credentials['email'],
                'email_verified_at' => now(),
                'password' => Hash::make($credentials['password'])
            ]);

            $response['message'] = 'User create successfully.';
            $response['data'] = true;
            return response()->json($response, 200);

        } catch (\Throwable $th) {
            $response['message'] = 'oops, something is not right'; //$th->getMessage()
            $response['status'] = 'warning';

            return response()->json($response, 500);
        }
    }
}
