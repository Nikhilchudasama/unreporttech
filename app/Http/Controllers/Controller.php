<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Sends failed response to the API request
     *
     * @param string $message
     * @param array $data
     * @param int $statusCode
     * @return json
    */
    protected function respondWithFailure($message, $data = [], $statusCode = 401)
    {
        return $this->respond($message, $data, false, $statusCode);
    }

    /**
     * Sends response to the API request
     *
     * @param string $message
     * @param array $data
     * @param boolean $status
     * @param int $statusCode
     * @return json
     */
    protected function respond($message, $data = [], $status = true, $statusCode = 200)
    {
        $data = $data ?: null;

        if($data){
            return response()->json([
                'status' => $status,
                'message' => $message,
                'statusCode' => $statusCode,
                'data' => $data,
            ],$statusCode);
        }else{
            return response()->json([
                'status' => $status,
                'message' => $message,
                'statusCode' => $statusCode,
            ],$statusCode);
        }

    }
}
