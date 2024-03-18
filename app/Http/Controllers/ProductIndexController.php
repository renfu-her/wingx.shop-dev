<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductMix;

use App\Models\ProductDetail;
use App\Models\ProductDetailOne;
use App\Models\ProductDetailTwo;
use App\Models\ProductTitleOne;
use App\Models\ProductTitleTwo;

use App\Services\CartService;

class ProductIndexController extends Controller
{
    // 產品細項，購買訊息的頁面
    public function index(Request $request, $product_id)
    {

        // dd(session()->get('cart'));
        $product = Product::find($product_id);
        $product_category = ProductCategory::find($product->category_id);
        $product_categories = ProductCategory::all();

        $product_images = ProductImage::where('product_id', $product_id)->get();
        foreach ($product_images as $product_image) {
            if ($product_image->define_image == 0) {
                $product_image->image_url = 'https://down-tw.img.susercontent.com/file/' . $product_image->image;
            } else {
                $product_image->image_url = asset('upload/images/' . $product_image->product_id . '/' . $product_image->image);
            }
        }

        // $productMix = ProductMix::where('product_id', $product_id)->orderBy('sort')->get();
        // foreach ($productMix as $key => $value) {
        //     $product_name = [];
        //     $product_name[0] = $product->name;
        //     $product_mix1 = Product::find($value->product_mix1);
        //     $product_mix2 = Product::find($value->product_mix2);
        //     $product_name[1] = $product_mix1->name;
        //     if ($product_mix2) {
        //         $product_name[2] = $product_mix2->name;
        //     }
        //     $productMix[$key]->product_name = implode(' ＋ ', $product_name);
        // }

        $total = 0;
        $tax = 0;
        $cart = (new CartService())->getCartAll();
        foreach ($cart as $key => $value) {
            $total += $value['prod_price'] * $value['qty'];
            $tax +=  ($value['prod_price'] * $value['qty']) * 0.05;
        }

        $cart_count = (new CartService())->getCart();
        $cart_count = json_decode($cart_count->getContent(), true);

        // product title
        $productTitleOne = ProductTitleOne::where('product_id', $product_id)->first();
        $productTitleTwo = ProductTitleTwo::where('product_id', $product_id)->first();

        // product detail
        $productDetailOne = ProductDetailOne::where('product_id', $product_id)->get();
        $productDetailTwo = ProductDetailTwo::where('product_id', $product_id)->get();

        return view(
            'frontend.product',
            compact(
                'product',
                'product_category',
                'product_images',
                'product_categories',
                'product_id',
                // 'productMix',
                'cart',
                'total',
                'tax',
                'cart_count',
                'productTitleOne',
                'productTitleTwo',
                'productDetailOne',
                'productDetailTwo',
            )
        );
    }

    // 產品 order detail 的金額
    public function priceGet(Request $request)
    {
        $data = $request->all();

        $optionOne = $data['options1'];
        $optionTwo = $data['options2'];
        $product_id = $data['product_id'];
        $option1 = [];
        $option2 = [];

        $titleOne = ProductTitleOne::where('product_id', $product_id)->first();
        $titleTwo = [];

        $productDetail = ProductDetail::where('product_id', $product_id)->first();

        $option1 = ProductDetailOne::where('id', $optionOne)->first();

        $detail = ProductDetail::where('product_id', $product_id)
            ->where('title_one_id', $option1->id);

        if ($optionTwo != 0) {
            $option2 = ProductDetailTwo::where('id', $optionTwo)->first();
            $detail = $detail->where('title_two_id', $option2->id);
            $titleTwo = ProductTitleTwo::where('product_id', $product_id)->first();
        }

        $items = $titleOne->name . '：' . $option1->name;
        if ($optionTwo != 0) {
            $items .= "<br>" . $titleTwo->name . '：' . $option2->name;
        }
        $detail = $detail->first();

        return response()->json(['price' => $detail->price, 'num' => $detail->num, 'items' => $items]);
    }

    // 規格 1 or 2 
    public function spec(Request $request)
    {

        $data = $request->all();

        $product_id = $data['product_id'];
        $num = $data['num'];

        if ($num == 1) {
            $details = ProductDetailOne::where('product_id', $product_id)->get();
        } else {
            $details = ProductDetailTwo::where('product_id', $product_id)->get();
        }

        if (!empty($details)) {
            $html = '';
            foreach ($details as $key => $detail) {
                if ($key == 0) {
                    $html .= $this->makeForm($detail, 'add', $num, $key);
                } else {
                    $html .= $this->makeForm($detail, 'delete', $num, $key);
                }
            }

            return $html;
        }
    }

    private function makeForm($data, $addOrDel = 'delete', $num, $key)
    {
        $makeNum = '';
        $options = '1';
        if ($num == 2) {
            $makeNum = '-2';
            $options = '2';
        }

        $makeNumRow = '';
        if ($addOrDel == 'add') {
            $makeNumRow = 'newRow' . $makeNum;
        }

        $html = '<div class="input-group mb-3 col-4 ' . $makeNumRow . '" id="input-form-row' . $makeNum . '" >';
        $html .= '<input type="text" name="options' . $options . '[]" class="form-control m-input" placeholder="輸入選項" autocomplete="off" value="' . $data['name'] . '" >';


        if ($addOrDel == 'add') {
            $html .= '<button class="btn btn-success" type="button" id="addRow' . $makeNum . '">+</button>';
        } else {
            $html .= '<button class="btn btn-danger" type="button" id="removeRow' . $makeNum . '">-</button>';
        }

        $html .= '</div>';

        return $html;
    }

    // 列表
    public function specList(Request $request)
    {
        $data = $request->all();

        $product_id = $data['product_id'];

        $titleOne = ProductTitleOne::where('product_id', $product_id)->first();
        $titleTwo = ProductTitleTwo::where('product_id', $product_id)->first();

        $header = '';
        $col = '';
        if (!empty($titleTwo)) {
            $header .= '<div class="col bordered-div gray-div title1">' . $titleOne->name . '</div>
               <div class="col bordered-div gray-div title2">' . $titleTwo->name . '</div>
               <div class="col bordered-div gray-div">金額</div>
               <div class="col bordered-div gray-div">數量</div>';

            $detailOne = ProductDetailOne::where('product_id', $product_id)->get();
            $detailTwo = ProductDetailTwo::where('product_id', $product_id)->get();
            $detailTwo = ProductDetailTwo::where('product_id', $product_id)->get();

            foreach ($detailOne as $key => $one) {
                $col .= '<div class="row">
                <div class="col bordered-div">' . $one['name'] . '</div>
                <div class="col-9">';

                $productDetail = ProductDetail::where('product_id', $product_id)
                    ->where('title_one_id', $one['id'])
                    ->get();

                foreach ($productDetail as $key2 => $detail) {

                    $two = ProductDetailTwo::find($detail['title_two_id']);

                    $col .= '<div class="row">
                    <div class="col bordered-div gray-div">' . $two['name'] . '</div>
                    <div class="col bordered-div">
                      <input class="form-control" type="number" name="price[]" value="' . $detail['price'] . '" />
                    </div>
                    <div class="col bordered-div">
                      <input class="form-control" type="number" name="num[]" value="' . $detail['num'] . '" />
                    </div>
                    </div>';
                }


                $col .= '</div></div>';
            }
        } else {

            $detailOne = ProductDetailOne::where('product_id', $product_id)->get();

            $header .=
                '<div class="col bordered-div gray-div title1">規格一</div>
                    <div class="col bordered-div gray-div title2" style="display:none"></div>
                    <div class="col bordered-div gray-div">金額</div>
                <div class="col bordered-div gray-div">數量</div>';

            if (!empty($titleOne)) {
                $header = '';
                $header .=
                    '<div class="col bordered-div gray-div title1">' . $titleOne->name . '</div>
                <div class="col bordered-div gray-div title2" style="display:none"></div>
                <div class="col bordered-div gray-div">金額</div>
               <div class="col bordered-div gray-div">數量</div>';

                foreach ($detailOne as $key => $one) {
                    $col .= '<div class="row">
                <div class="col bordered-div">' . $one['name'] . '</div>';

                    $productDetail = ProductDetail::where('product_id', $product_id)
                        ->where('title_one_id', $one['id'])
                        ->get();

                    foreach ($productDetail as $key2 => $detail) {


                        $col .= '<div class="col bordered-div">
                      <input class="form-control" type="number" name="price[]" value="' . $detail['price'] . '" />
                    </div>
                    <div class="col bordered-div">
                      <input class="form-control" type="number" name="num[]" value="' . $detail['num'] . '" />
                    </div>';
                    }


                    $col .= '</div></div>';
                }
            }
        }

        return response()->json(['header' => $header, 'col' => $col]);
    }
}
