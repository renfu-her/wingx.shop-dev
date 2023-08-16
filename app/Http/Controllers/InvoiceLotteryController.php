<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\InvoiceLottery;

class InvoiceLotteryController extends Controller
{
    // read xml convert json
    public function readXmlToJson()
    {
        $url = "https://invoice.etax.nat.gov.tw/invoice.xml";
        $xmlString = file_get_contents($url);

        if ($xmlString) {
            $xml = simplexml_load_string($xmlString);

            // 遍歷每個 item
            foreach ($xml->channel->item as $item) {
                $title = (string) $item->title;
                $description = (string) $item->description;  // strip_tags() 可以移除 HTML 標籤
                $description_strip_p = str_replace(['<p>', '</p>'], ['', '|'], $description);
                $description_explode = explode('|', $description_strip_p);

                $year_month = explode(" ", $title);
                $year = $year_month[0];
                $month = $year_month[1];
                $special_bonus_arr = explode("：", $description_explode[0]);
                $special_award_arr = explode("：", $description_explode[1]);
                $jackpot_arr = explode("：", $description_explode[2]);

                $invoiceLottery = InvoiceLottery::where('year', $year)->where('month', $month)->first();
                if (!$invoiceLottery) {
                    $invoiceLottery = new InvoiceLottery();
                    $invoiceLottery->year = $year;
                    $invoiceLottery->month = $month;
                    $invoiceLottery->special_bonus = $special_bonus_arr[1];
                    $invoiceLottery->special_award = $special_award_arr[1];
                    $invoiceLottery->jackpot = $jackpot_arr[1];
                    $invoiceLottery->save();
                }
            }
        } else {
            echo "Failed to load XML.";
        }
    }
}
