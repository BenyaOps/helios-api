<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Departments;

class DepartmentsController extends Controller
{
    public function index()
    {
        return  $this->response(200, 'SUCCESSFUL');
    }

    public function list()
    {
        $departments = Departments::get();
        $data = [
            'departments' => $departments
        ];
        return  $this->response(200, 'SUCCESSFUL', $data);
    }
}
