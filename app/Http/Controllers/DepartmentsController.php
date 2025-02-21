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
        $filter_column_name = $request->query('filter_column_name', 'name');
        $validColumns = ['name', 'employees_quantity', 'ambassor_id', 'nivel','department_id', 'department_name'];
        if (!in_array($orderColum, $validColumns)) {
            return response()->json(['error' => 'Columna de ordenamiento no válida'], 400);
        }
        if ($filter_column_name && !in_array($filter_column_name, $validColumns)) {
            return response()->json(['error' => 'Columna de filtro no válida'], 400);
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
        ->when($searchName, function ($query, $searchName) use ($filter_column_name) {
            return $query->where('departments.'.$filter_column_name, 'like', '%' . $searchName . '%');
        })
        ->orderBy($orderColum, $order)
        ->limit($itemsPerPage)
        ->offset($offset)
        ->get(['departments.id as department_id', 'departments.name as department_name',
             'departments.superior_id', 'departments.nivel', 'departments.employees_quantity',
             'ambassadors.name as ambassador_name',
             DB::raw('COUNT(sub_departments.id) as sub_departments_count')]);
        $query->map(function ($department) {
            $department->superior_name = Departments::where('id', $department->superior_id)->value('name');
            return $department;
        });
        //var_dump($query);die();

        $data = [];
        $data['departments'] = $query;
        $data['total'] = Departments::count();
        $data['total_employee'] = Departments::sum('employees_quantity');
        $data['page'] = $page;
        $data['itemsPerPage'] = $itemsPerPage;
        return  $this->response(200, 'SUCCESSFUL', $data);
    }
}
