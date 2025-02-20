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

    public function list(Request $request)
    {
        $page = $request->input('page', 1);
        $count = $request->input('count', 10);
        $offset = ($page - 1) * $count;

        $departments = Departments::join('ambassadors', 'departments.ambassador_id', '=', 'ambassadors.id')
            ->offset($offset)
            ->limit($count)
            ->get(["departments.id as department_id", "departments.name as department_name",
             "superior_id","nivel","employees_quantity","ambassadors.name as ambassador_name"
        ]);

        $data = [];
        $data['departments'] = $departments;
        return  $this->response(200, 'SUCCESSFUL', $data);
    }
}
