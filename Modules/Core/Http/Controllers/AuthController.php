<?php

namespace Modules\Core\Http\Controllers;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
   public function login()
   {
       return view('core::auth.login');
   }

   public function logout()
   {
         auth()->logout();
         return redirect()->route('login');
   }
}
