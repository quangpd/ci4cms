<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminController extends BaseController
{
    public function index()
    {
        $this->data['title'] = 'Admin';

        return view('backend/index', $this->data);
    }
}
