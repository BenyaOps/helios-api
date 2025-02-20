<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Departments;
use Illuminate\Support\Facades\DB;

class DepartmentsController extends Controller
{
    public function index()
    {
        return  $this->response(200, 'SUCCESSFUL');
    }

    public function list(Request $request)
    {
        $orderColum = $request->query('order_column', 'department_id');
        $validColumns = ['name', 'employees_quantity', 'ambassor_id', 'nivel','department_id', 'department_name'];
        if (!in_array($orderColum, $validColumns)) {
            return response()->json(['error' => 'Columna de ordenamiento no válida'], 400);
        }
        $order = $request->query('order', 'desc');
        $page = $request->query('page', 1);
        $itemsPerPage = $request->query('item_to_page', 10);
        $offset = ($page - 1) * $itemsPerPage;
        $searchName = $request->query('search_name');

        $query = Departments::join('ambassadors', 'departments.ambassador_id', '=', 'ambassadors.id')
        ->leftJoin('departments as sub_departments', 'departments.id', '=', 'sub_departments.superior_id')
        ->groupBy('departments.id', 'departments.name', 'departments.superior_id',
              'departments.nivel', 'departments.employees_quantity',
              'ambassadors.name')
        ->limit($itemsPerPage)
        ->offset($offset)
        ->when($searchName, function ($query, $searchName) {
            return $query->where('departments.name', 'like', '%' . $searchName . '%');
        })
        ->get(['departments.id as department_id', 'departments.name as department_name',
             'departments.superior_id', 'departments.nivel', 'departments.employees_quantity',
             'ambassadors.name as ambassador_name',
             DB::raw('COUNT(sub_departments.id) as sub_departments_count')]);
        //var_dump($query);die();

        $data = [];
        $data['departments'] = $query;
        $data['total'] = Departments::count();
        $data['page'] = $page;
        $data['itemsPerPage'] = $itemsPerPage;
        return  $this->response(200, 'SUCCESSFUL', $data);
    }
}
