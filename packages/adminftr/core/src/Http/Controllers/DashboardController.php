<?php
namespace Future\Core\Http\Controllers;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('future::dashboard');
    }
}
