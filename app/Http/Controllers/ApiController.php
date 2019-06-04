<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    //id,pwで認証してtokenを発行
    function login(){

        // $credentials = request(['api_key', 'password']);
        
        $credentials = [
            'iss' => 'SJTZrQuZR_Ctc57N-FcNGw',
            'exp' => strtotime('+1 week') ,
        ];
        
        
        /*
        API Key
        SJTZrQuZR_Ctc57N-FcNGw
        
        API Secret
        sUx9LzIFrBAm1Ysmac2hIgGAbgBFIdlUcm3F
        
        IM Chat History Token
        eyJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJWU20ya1hsRFJNT0VDUllpYTJjVnpRIn0.tZA8CGjJFKks461Owr0_TILIvvtT35VWicWy6eOAS1w
        
        JWT Token
        eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6IlNKVFpyUXVaUl9DdGM1N04tRmNOR3ciLCJleHAiOjE1NjAyNDE1NjgsImlhdCI6MTU1OTYzNjc2N30.RPbS-dHs26avtVoO8C4kRxp9oDp2Fy1JlBwY1nx5c34
        
        
        
        https://localhost-cresta522-1.paiza-user.cloud:8000/
        curl http://localhost:8080/api/login -d email=hoge@test.com -d password=testtest
        
        
        curl https://localhost-cresta522-1.paiza-user.cloud:8000/api/login -d email=hoge@test.com -d password=testtest
        
        */
        
        // getJWTIdentifier

        //もし認証エラーなら
        // if(!$token = auth('api')->attempt($credentials)){
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }
        
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6IlNKVFpyUXVaUl9DdGM1N04tRmNOR3ciLCJleHAiOjE1NjAyNDE1NjgsImlhdCI6MTU1OTYzNjc2N30.RPbS-dHs26avtVoO8C4kRxp9oDp2Fy1JlBwY1nx5c34';

        //OKならtoken発行
        return $this->respondWithToken($token);
    }

    //自分の情報返す
    public function me()
    {
        return response()->json(auth()->user());
    }

    //token発行（内部利用）
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expire_in' => auth('api')->factory()->getTTL(),
        ]);
    }
}
