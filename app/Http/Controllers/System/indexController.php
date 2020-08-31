<?php

namespace App\Http\Controllers\system;

use App\Http\Controllers\Controller;
use ekHelper;
use Illuminate\Http\Request;

class indexController extends ResourceController
{
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $id = "")
    {
        // dd(ekHelper::hasPermission('/backend/users'));
        $data['breadcrumbs'] = $this->breadcrumbForIndex();
        return $this->renderView('index', $data);
    }

    public function moduleName()
    {
        return 'home';
    }

    /**
     * @returns {string}
     */
    public function viewFolder()
    {
        return 'system.home';
    }
}
