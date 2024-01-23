<?php
namespace Future\Messages\Http\Controllers;

use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index()
    {
        return view('future::chat');
    }
}
