<?php

namespace App\Utils;


class ResponseHelper
{
    public static function response_json($status_code = 200,$msg = "",$data=NULL)
    {

        return response()->json([
            "error" => [
                'status_code' => $status_code,
                'msg' => $msg
            ],
            "data" => $data,
        ]);
    }

}
