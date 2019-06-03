<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    //id,pwで認証してtokenを発行
    function login(){

        $credentials = request(['api_key', 'password']);
        dd($credentials);
        $credentials = ['iss' => 'SJTZrQuZR_Ctc57N-FcNGw'];
        
        // payload = { 
        //         iss: 'api_key', #api_key
        //         exp: Time.now.to_i + 4 * 3600
        //     };
        
        /*
        API Key
        SJTZrQuZR_Ctc57N-FcNGw
        
        API Secret
        sUx9LzIFrBAm1Ysmac2hIgGAbgBFIdlUcm3F
        
        IM Chat History Token
        eyJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJWU20ya1hsRFJNT0VDUllpYTJjVnpRIn0.tZA8CGjJFKks461Owr0_TILIvvtT35VWicWy6eOAS1w
        
        JWT Token
        eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6IlNKVFpyUXVaUl9DdGM1N04tRmNOR3ciLCJleHAiOjE1NjAxMjgwNTcsImlhdCI6MTU1OTUyMzI1NX0.N9IUJ42mBEPuXIC_4YW5OlhhXK3AJ19EhtxS-XLcDJM
        
        
        
        https://localhost-cresta522-1.paiza-user.cloud:8000/
        curl http://localhost:8080/api/login -d email=hoge@test.com -d password=testtest
        
        
        curl https://localhost-cresta522-1.paiza-user.cloud:8000/api/login -d email=hoge@test.com -d password=testtest
        
        */
        

        //もし認証エラーなら
        if(!$token = auth('api')->attempt($credentials)){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

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
