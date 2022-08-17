<?php namespace Netgen\Register\Components;

use Cms\Classes\ComponentBase;
use Input;
use DB;
use GuzzleHttp\Psr7\Request;
use Winter\Storm\Support\Facades\Flash;
use Illuminate\Support\Facades\Hash;
use RainLab\User\Models\User;

class Registration extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Registration Component',
            'description' => 'No description provided yet...'
        ];
    }

    // public function defineProperties()
    // {
    //     return [];
    // }


    function onRegisteUser(){    
       

      $data =  DB::table('users')->insert([
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'password' => Hash::make(Input::get('otp')),
            'fathername' => Input::get('fathername'),
            'mothername' => Input::get('mothername'),
            'academicyear' => Input::get('academicyear'),
            'otp' => Input::get('otp'),
            'is_principal' => 0,
        ]);
        return response()->json([
            'data' => $data,
        ]);
        
    }
}
