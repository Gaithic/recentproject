<?php namespace Netgen\Register\Components;

use Cms\Classes\ComponentBase;
use Auth;
use Backend\Facades\Backend;
use Illuminate\Support\Facades\Redirect;

class UserLogin extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'UserLogin Component',
            'description' => 'No description provided yet...'
        ];
    }

    // public function defineProperties()
    // {
    //     return [];
    // }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);
        
        $credentials = $request->only('mobile', 'otp');
        if (Auth::attempt($credentials)) {
            return Redirect::to('/user-dashboard');
        }

        // return redirect("")->withSuccess('Oppes! You have entered invalid credentials');
    }
}
