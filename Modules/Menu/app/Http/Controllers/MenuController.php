<?php

namespace Modules\Menu\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('menu::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menu::create');
    }
}
