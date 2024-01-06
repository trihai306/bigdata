<?php

namespace Future\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Kreait\Firebase\Factory;
use Illuminate\Http\Request;
class AuthController extends Controller
{
   public function login()
   {
       return view('future::auth.login');
   }

   public function logout()
   {
         auth()->logout();
         return redirect()->route('login');
   }

    public function forgotPassword()
    {
         return view('future::auth.forgot-password');
    }

    public function requestOTP(Request $request)
    {
        $phoneNumber = $request->input('phone_number');

        $firebase = (new Factory)
            ->withServiceAccount(config('firebase.credentials'))
            ->withDatabaseUri(config('firebase.database_url'))
            ->createAuth();
        $verificationID = $firebase->verifyPhoneNumber($phoneNumber);

        return response()->json(['verificationId' => $verificationID]);
    }

    public function verifyOTP(Request $request)
    {
        $verificationID = $request->input('verification_id');
        $verificationCode = $request->input('verification_code');

        $firebase = (new Factory)
            ->withServiceAccount(config('firebase.credentials'))
            ->createAuth();

        try {
            $signInResult = $firebase->getAuth()->signInWithPhoneNumber($verificationID, $verificationCode);
            return response()->json(['token' => $signInResult->firebaseToken()]);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

}
