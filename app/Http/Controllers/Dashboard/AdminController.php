<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\AdminInterface;

class AdminController extends Controller
{
    protected $adminInterface;

    public function __construct(AdminInterface $adminInterface)
    {
        return $this->adminInterface = $adminInterface;
    }

    public function index()
    {
        return $this->adminInterface->index();
    }


}
