<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductShip;
use App\Models\Ship;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // get product category
    public function getProductCategory()
    {
        $product_categories = ProductCategory::orderBy('sort')->get();

        return $product_categories;
    }

    // get product
    public function getProduct()
    {
        $products = [];
        $product_categories = ProductCategory::orderBy('sort')->get();
        foreach ($product_categories as $key => $value) {

            $products[$key] = [];

            $pd = Product::inRandomOrder()->where('category_id', $value->id)->take(20)->get();
            if (count($pd) > 0) {
                foreach ($pd as $k => $v) {
                    $products[$key][$k] = $v;
                    if ($v->define_image == 0) {
                        $products[$key][$k]['image_url'] = 'https://down-tw.img.susercontent.com/file/' . $v->image;
                    } else {
                        $products[$key][$k]['image_url'] = asset('upload/images/' . $v->id . '/' . $v->image);
                    }
                }
            }
        }

        return $products;
    }

    // get ship all
    public function getShipAll()
    {
        $ships = Ship::where('status', 1)->get();
        $carts = session()->get('cart');

        foreach($carts as $cart) {
            // dd($cart);
        }

    dd($carts);
        return $ships;
    }

    /**
     * 綠界檢查碼產生器
     *
     * @author Liao San Kai
     * @param array $params 表單資料
     * @param string $hashKey hashKey
     * @param string $hashIV hashIV
     * @param int $encType 編碼方式 (1=sha256, 0=md5)
     * @return string
     */
    function ecpayCheckMacValue(array $params, $hashKey, $hashIV, $encType = 1)
    {
        // 0) 如果資料中有 null，必需轉成空字串
        $params = array_map('strval', $params);

        // 1) 如果資料中有 CheckMacValue 必需先移除
        unset($params['CheckMacValue']);

        // 2) 將鍵值由 A-Z 排序
        uksort($params, 'strcasecmp');

        // 3) 將陣列轉為 query 字串
        $paramsString = urldecode(http_build_query($params));

        // 4) 最前方加入 HashKey，最後方加入 HashIV
        $paramsString = "HashKey={$hashKey}&{$paramsString}&HashIV={$hashIV}";

        // 5) 做 URLEncode
        $paramsString = urlencode($paramsString);

        // 6) 轉為全小寫
        $paramsString = strtolower($paramsString);

        // 7) 轉換特定字元(與 dotNet 相符的字元)
        $search  = ['%2d', '%5f', '%2e', '%21', '%2a', '%28', '%29'];
        $replace = ['-',   '_',   '.',   '!',   '*',   '(',   ')'];
        $paramsString = str_replace($search, $replace, $paramsString);

        // 8) 進行編碼
        $paramsString = $encType ? hash('sha256', $paramsString) : md5($paramsString);

        // 9) 轉為全大寫後回傳
        return strtoupper($paramsString);
    }
}
