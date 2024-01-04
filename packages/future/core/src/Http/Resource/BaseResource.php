<?php

namespace Future\Core\Http\Resource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


abstract class BaseResource extends Controller
{
    protected BaseTable $table;
    protected BaseForm $form;
    public function __construct(
        BaseTable $table,
        BaseForm $form
    ) {
        $this->table = $table;
        $this->form = $form;
    }

    public function index(Request $request)
    {
        $table = $this->table;
        return view('core::Resource.index',compact('table'));
    }

    public function create()
    {
        $form = $this->form;
        return view('core::Resource.create',compact('form'));
    }

    public function edit($id)
    {
        $form = $this->form;
        return view('core::Resource.edit',compact('form','id'));
    }
}
