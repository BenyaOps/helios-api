<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Utils\ResponseHelper;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $token;
    protected $service;
    protected $model;


    protected function response_json($status_code = 0,$msg = "",$data=NULL){
        return  response()->json([
            "error" => [
                'status_code' => $status_code,
                'msg' => $msg
            ],
            "data" => $data,
        ]);

    }

    protected function response($status_code,$message,$data = NULL){
    	return ResponseHelper::response_json($status_code,$message,$data);
    }
}
