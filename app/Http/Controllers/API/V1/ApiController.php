<?php

namespace App\Http\Controllers\API\V1;

use App\AppversionSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    protected $statusCode = 200;
    /**
     * Sends failed response to the API request
     *
     * @param string $message
     * @param array $data
     * @param int $statusCode
     * @return json
    */
    protected function respondWithFailureApi($message, $data = [], $header = true)
    {
        return $this->respond($message, $data, false, $header, $this->statusCode);
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
    protected function respondApi($message, $data = [], $status = true, $header = true)
    {
        $data = $data ?: null;

        if($data){
            return response()->json([
                'header' => $header,
                'status' => $status,
                'message' => $message,
                'statusCode' => $this->statusCode,
                'data' => $data,
            ],$this->statusCode);
        }else{
            return response()->json([
                'header' => $header,
                'status' => $status,
                'message' => $message,
                'statusCode' => $this->statusCode,
            ],$this->statusCode);
        }
    }

    /**
     * Ternary Function
     *
     * @param string $string
     * @return string
     **/
    protected function ternary($string = null)
    {
        return $string ? $string : '';
    }

    /**
     * Check API header
     *
     * @param string $xversion
     * @param string $xos
     * @param string $xtimestamp
     * @return string
     */
    public function checkHeader(){
        $xversion = $this->ternary(request()->header('x-version'));
        $xos = $this->ternary(request()->header('x-os'));
        $xtimestamp = $this->ternary(request()->header('x-timestamp'));
        if($xversion == '')
        return "Invalid URL";
        if($xos == '')
        return "Invalid URL";
        if($xtimestamp == '')
        return "Invalid URL";

        $setting = AppversionSetting::first();
        if($xos != "ios" && $xos != "android"){
            return "Device Unauthorized";
        }
        if($xos == 'ios'){
            if($setting->ios != $xversion){
                return "You need Application Update";
            }
        }
        if($xos == 'android'){
            if($setting->android != $xversion){
                return "You need Application Update";
            }
        }
        return null;
    }
}
