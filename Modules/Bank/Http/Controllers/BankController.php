<?php

namespace Modules\Bank\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Str;
class BankController extends Controller
{
    public function nn1()
    {
        return view('bank::components.nn1');
    }

    public function nn2()
    {
        return view('bank::components.nn2');
    }

    public function nn3()
    {
        return view('bank::components.nn3');
    }

    public function nn4()
    {
        return view('bank::components.nn4');
    }

    public function nn5()
    {
        return view('bank::components.nn5');
    }

    public function techcombank()
    {
        return view('bank::components.techcombank');

    }
}
