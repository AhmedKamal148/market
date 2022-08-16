<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\AdminInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminInterface;

    public function __construct(AdminInterface $adminInterface)
    {
        return $this->adminInterface = $adminInterface;
    }

    public function index()
    {
        return  view('admin.pages.home');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
