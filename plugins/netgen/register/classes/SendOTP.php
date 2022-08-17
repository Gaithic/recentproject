<?php
namespace Netgen\Register\Classes;

use Backend\Facades\Backend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use RainLab\User\Facades\Auth;


class SendOtp{

    // public function sendOtp(Request $request) {
       

    // }

    public function generateOTP(Request $request){
        $data = 12345;
        $mobile = $request->mobile;
        $email = $request->email;
        $academic = date('Y');
        $check = "Email is Already Exist, Kindly login and try next year for registration with the new Acadamic Scholarship Year..";
        $phoneError = "Phone is Already Exist, Kindly login and try next year for registration with the new Acadamic Scholarship Year..";
        $academicYear = DB::table('users')->whereEmail($email)->value('academicyear');
        $phoneNumber = DB::table('users')->whereMobile($mobile)->value('academicyear');
        if($academicYear == $academic){
            return response()->json([
                'check' => $check,
                'success' 	=> 'emailError',
                'phoneNumber' =>  $phoneNumber,
            ]);
        }else{
            if($phoneNumber == $academic ){
                return response()->json([
                    'phoneError' => $phoneError,
                    'success' 	=> 'phoneError',
                    'phoneNumber' =>  $phoneNumber,
                ]);
            }else{
                $insertOtp =  DB::table('users')->insertGetId([
                    'mobile'=> $mobile,
                    'otp' => $data,
                ]);
                return response()->json([
                    'data' => $data,
                    'academicYear' => $academicYear,
                    'phoneNumber' =>  $phoneNumber,
                ]);
            }
        }
        
    }

    public function saveRegisterUser(Request $request){
        $mobile = $request->mobile;
        $otp = $request->otp;
        $email = $request->email;
        $verifyOtp = DB::table('users')->whereMobile($mobile)->value('otp');
        if($otp == $verifyOtp){
            $user = \RainLab\User\Models\User::whereMobile($mobile)->first();
            $mobile = $request->mobile;
            $name = $request->name;
            $fathername = $request->fathername;
            $mothername = $request->mothername;
            $gender = $request->gender;
            $activated = 1;
            $academic = date('Y');
            $principal = 0;
            $add    = DB::table('users')->where('mobile', $mobile)->update([
                'email'=> $email,
                'otp' => $verifyOtp,
                'password' => Hash::make('Netgen@123'),
                'mobile' => $mobile,
                'name' => $name,
                'fathername' => $fathername,
                'mothername' => $mothername,
                'gender' => $gender,
                'academicyear' => $academic,
                'is_principal' => $principal,
                'is_activated' => $activated
            ]);
            $res = Auth::loginUsingId($user->id);
            return response()->json([
                'success' 	=> false,
				'msg' 		=> 'Otp Verified.',
                'user'      => Auth::getUser(),
            ]);
            
        }else{

            return response()->json([
                'success' 	=> false,
				'msg' 		=> 'Wrong Otp.',
                'otp' => $otp,
                'verifyOtp' => $verifyOtp,
            ]);
        }
    }

    public function generateLoginOTP(Request $request){
        $mobile = $request->mobile;
        $data = 45678;
        $add = DB::table('users')
              ->where('mobile', $mobile)
              ->update(['otp' => $data]);

        return response()->json([
            'add' => $add,
        ]);
    }




    public function verifyOtp(Request $request){
        $mobile = $request->mobile;
        $otp = $request->otp;
        $verifyOtp = DB::table('users')->whereMobile($mobile)->value('otp');

        if($otp == $verifyOtp){
            $user = \RainLab\User\Models\User::whereMobile($mobile)->first();
            $res = Auth::loginUsingId($user->id);
            
            return response()->json([
                'success' 	=> true,
                'user'      => Auth::getUser(),
				'msg' 		=> 'Otp Verified.',
            ]);
        }else{
            return response()->json([
                'success' 	=> false,
				'msg' 		=> 'Wrong Otp.',
            ]);
        } 
    }

}