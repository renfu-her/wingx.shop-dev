<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\InvoiceLottery;

class InvoiceLotteryController extends Controller
{
    // read xml convert json
    public function readXmlToJson()
    {
        $xml = simplexml_load_file('https://invoice.etax.nat.gov.tw/invoice.xml');
        $json = json_encode($xml);
        $array = json_decode($json, true);
        return $array;
    }
}
