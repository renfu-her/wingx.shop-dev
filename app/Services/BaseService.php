<?php

namespace App\Services;

use App\Models\Ship;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * Class BaseService
 * @package App\Services
 */
class BaseService
{

    private $response;
    private $user_id;
    private $headers = array(
        "Cache-Control" => 'no-cache, no-store, must-revalidate',
        'X-Content-Type-Options' => 'nosniff',
        'X-XSS-Protection' => '1',
        'Content-Type' => 'application/json; charset=utf-8',

    );

    // get ship all
    public function getShipAll()
    {
        $ships = Ship::all();
        return $ships;
    }

    public function getResponse(): mixed
    {
        return $this->response;
    }

    public function setResponse(mixed $response): self
    {
        $this->response = $response;
        return $this;
    }

    public function response($code, $message = "", $data = [])
    {
        $res = [
            "code" => $code,
            "msg" => $message,
            "data" => $data
        ];
        return response()->json($res, 200, $this->headers, JSON_UNESCAPED_UNICODE);
    }

    public function response_paginate($code, $message = "", $data = [], $page = [])
    {
        $res = [
            "code" => $code,
            "msg" => $message,
            "page" => $page,
            "data" => $data
        ];
        return response()->json($res, 200, $this->headers, JSON_UNESCAPED_UNICODE);
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function array_replace_key($array, $old_key, $new_key)
    {
        $keys = array_keys($array);
        $index = array_search($old_key, $keys);
        $keys[$index] = $new_key;
        return array_combine($keys, array_values($array));
    }

    public function statusToString($str)
    {
        $status_str = "";
        switch ($str) {
            case 1:
                $status_str = "pending";
                break;
            case 2:
                $status_str = "processing";
                break;
            case 3:
                $status_str = "solved";
                break;
            case 4:
                $status_str = "closed";
                break;
            case 5:
                $status_str = "in";
                break;
            case 6:
                $status_str = "out";
                break;
        }
        return $status_str;
    }

    /** dateROCToAD()
     *  民國轉西元年
     *  @param string $str 民國 yyymmdd 或 yyy/mm/dd 或yyy-mm-dd
     *  @param string $replace
     *  @return string yyyy-mm-dd
     */
    public function dateROCToAD($str, $replace)
    {
        $str = str_replace("/", "", $str);
        $str = str_replace("-", "", $str);

        $data = [];
        $date_array = str_split($str);
        $roc = [];
        array_push($roc, $date_array[0]);
        array_push($roc, $date_array[1]);
        array_push($roc, $date_array[2]);

        $mm = [];
        array_push($mm, $date_array[3]);
        array_push($mm, $date_array[4]);
        $dd = [];
        array_push($dd, $date_array[5]);
        array_push($dd, $date_array[6]);

        $roc = implode("", $roc);
        $mm = implode("", $mm);
        $dd = implode("", $dd);

        $ad = $roc + 1911;

        $date = implode($replace, [$ad, $mm, $dd]);
        return $date;
    }

    /** dateADToRoc()
     *  民國轉西元年
     *  @param string $str 西元 yyyymmdd 或 yyyy/mm/dd 或 yyyy-mm-dd
     *  @param string $replace
     *  @return string yyyy-mm-dd
     */
    public function dateADToRoc($str, $replace)
    {
        $str = str_replace("/", "", $str);
        $str = str_replace("-", "", $str);

        $data = [];
        $date_array = str_split($str);
        $ad = [];
        array_push($ad, $date_array[0]);
        array_push($ad, $date_array[1]);
        array_push($ad, $date_array[2]);
        array_push($ad, $date_array[3]);

        $mm = [];
        array_push($mm, $date_array[4]);
        array_push($mm, $date_array[5]);
        $dd = [];
        array_push($dd, $date_array[6]);
        array_push($dd, $date_array[7]);

        $ad = implode("", $ad);
        $mm = implode("", $mm);
        $dd = implode("", $dd);

        $roc = $ad - 1911;

        $date = implode($replace, [$roc, $mm, $dd]);
        return $date;
    }

    /** getUserId()
     *  取得使用者
     *  @return int
     */
    public function getUserId()
    {
        $this->user_id  = Auth::user()->id;
        return $this->user_id;
    }

    /** checkValiDate()
     *  @param obj|array $validate - Validation object
     *  @return array|object
     */
    public function checkValiDate($validate)
    {
        if ($validate->fails()) {
            list($code, $message) = explode(" ", $validate->errors()->first());
            return $this->response($code, $message);
        }
    }
    /** validatorAndResponse()
     *  資料驗證，並回傳一筆錯誤，response 格式。
     *  @param array $data 檢測資料
     *  @param array $relus 檢測條件
     *  @param array $message 錯誤訊息
     *  @param array $customAttributes
     *  @return obj
     */
    public function validatorAndResponse($data, $relus, $message = [], $customAttributes = [])
    {
        $vali = Validator::make($data, $relus, $message, $customAttributes);
        $errors = $this->checkValiDate($vali);
        if ($errors) {
            return $errors;
        }
    }


    public function authCode($string, $operation = 'DECODE', $key = '', $expiry = 0)
    {
        $ckey_length = 4;
        $key = md5($key ? $key : config('app.authKey'));
        if (trim($key) == '') {
            return '';
        }
        $keya = md5(substr($key, 0, 16));
        $keyb = md5(substr($key, 16, 16));
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';
        $cryptkey = $keya . md5($keya . $keyc);
        $key_length = strlen($cryptkey);
        $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) :  sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
        $string_length = strlen($string);
        $result = '';
        $box = range(0, 255);
        $rndkey = array();
        for ($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }
        for ($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
        for ($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            // 从密匙簿得出密匙进行异或，再转成字符
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }
        if ($operation == 'DECODE') {
            if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) &&  substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
                return substr($result, 26);
            } else {
                return '';
            }
        } else {
            return $keyc . str_replace('=', '', base64_encode($result));
        }
    }

    // saveBase File
    function saveBase64File($base64String, $path)
    {
        // 解析 Base64 字符串
        list($type, $data) = explode(';', $base64String);
        list(, $data)      = explode(',', $data);
        $type = explode(':', $type)[1];

        // 解码数据
        $data = base64_decode($data);

        // 确定文件扩展名
        $extension = '';
        switch ($type) {
            case 'image/jpg':
            case 'image/jpeg':
                $extension = 'jpg'; // 或者 'jpeg'，根据您的需求选择
                break;
            case 'image/png':
                $extension = 'png';
                break;
            case 'image/gif':
                $extension = 'gif';
                break;
            case 'application/vnd.ms-excel':
                $extension = 'xls';
                break;
            case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                $extension = 'xlsx';
                break;
            case 'application/msword':
                $extension = 'doc';
                break;
            case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                $extension = 'docx';
                break;
            case 'application/vnd.ms-powerpoint':
                $extension = 'ppt';
                break;
            case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
                $extension = 'pptx';
                break;
            case 'application/pdf':
                $extension = 'pdf';
                break;
                // 其他 MIME 类型...
        }

        // 构建完整文件路径
        $fileData = Str::uuid() . '.' . $extension;
        $filePath = "legal_cases/" . $fileData;

        // 使用 Storage 门面保存文件
        Storage::put($filePath, $data);

        return $fileData;
    }

    
}
