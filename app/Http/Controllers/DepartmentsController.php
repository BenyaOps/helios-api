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
        $page = $request->query('page', 1);
        $itemsPerPage = $request->query('item_to_page', 10);
        $offset = ($page - 1) * $itemsPerPage;
        //var_dump($offset);die();
        $departments = Departments::join('ambassadors', 'departments.ambassador_id', '=', 'ambassadors.id')
            ->offset($offset)
            ->limit($itemsPerPage)
            ->get(["departments.id as department_id", "departments.name as department_name",
             "superior_id","nivel","employees_quantity","ambassadors.name as ambassador_name"
        ]);

        $data = [];
        $data['departments'] = $departments;
        $data['total'] = Departments::count();
        $data['page'] = $page;
        $data['itemsPerPage'] = $itemsPerPage;
        return  $this->response(200, 'SUCCESSFUL', $data);
    }
}
