<?php

namespace App\Services;

use App\Services\BaseService;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductMix;

use App\Models\ProductTitleOne;
use App\Models\ProductTitleTwo;
use App\Models\ProductDetailOne;
use App\Models\ProductDetailTwo;
use App\Models\ProductDetail;

use App\Traits\RulesTrait;

/**
 * Class CartService
 * @package App\Services
 */
class ProductDetailService extends BaseService
{

    use RulesTrait;

    private $dataId;
    private $response;
    private $request;

    public function __construct($request, $dataId = null)
    {
        $this->dataId = $dataId;
        $this->request = collect($request);
    }

    public function edit()
    {

        $product = Product::find($this->dataId);

        $productTitleOne = ProductTitleOne::where('product_id', $this->dataId)->first();
        $productTitleTwo = ProductTitleTwo::where('product_id', $this->dataId)->first();

        $productTitleOneName = '';
        $productTitleTwoName = '';
        if (!empty($productTitleOne)) {
            $productTitleOneName = $productTitleOne->name;
        }
        if (!empty($productTitleTwo)) {
            $productTitleTwoName = $productTitleTwo->name;
        }

        return view(
            'backend.productDetail.index',
            compact('product', 'productTitleOne', 'productTitleTwo', 'productTitleOneName', 'productTitleTwoName')
        );
    }

    public function store()
    {
        $data = $this->request->toArray();

        // dd($data);
        $product_id = $data['product_id'];

        ProductDetail::where('product_id', $product_id)->delete();
        ProductDetailOne::where('product_id', $product_id)->delete();
        ProductDetailTwo::where('product_id', $product_id)->delete();
        ProductTitleOne::where('product_id', $product_id)->delete();
        ProductTitleTwo::where('product_id', $product_id)->delete();

        $titleOne = new ProductTitleOne();
        $titleOne->product_id = $product_id;
        $titleOne->name = $data['title1'];
        $titleOne->save();

        $title_one_id = $titleOne->id;

        foreach ($data['options1'] as $option) {
            $detailOne = new ProductDetailOne();
            $detailOne->product_id = $product_id;
            $detailOne->title_one_id = $title_one_id;
            $detailOne->name = $option;
            $detailOne->save();
        }

        if (!empty($data['title2'])) {
            $titleTwo = new ProductTitleTwo();
            $titleTwo->product_id = $product_id;
            $titleTwo->title_one_id = $title_one_id;
            $titleTwo->name = $data['title2'];
            $titleTwo->save();

            $title_two_id = $titleTwo->id;

            foreach ($data['options2'] as $option) {
                $detailTwo = new ProductDetailTwo();
                $detailTwo->product_id = $product_id;
                $detailTwo->title_two_id = $title_two_id;
                $detailTwo->name = $option;
                $detailTwo->save();
            }
        }

        $detailOne = ProductDetailOne::where('product_id', $product_id)->get();
        $detailOne = $detailOne->toArray();

        $detailTwo = ProductDetailTwo::where('product_id', $product_id)->get();
        $detailTwo = $detailTwo->toArray();

        // 寫入明細,DB 裏面截取相關性的資料

        $items = 0;
        $price = $data['price'];
        $num = $data['num'];
        foreach ($detailOne as $option) {

            if ($data['title2'] != null) {
                $arrIndex = 0;
                foreach ($data['options2'] as $option2) {
                    $productDetail = new ProductDetail();
                    $productDetail->product_id = $product_id;
                    $productDetail->title_one_id = $option['id'];

                    $productDetail->title_two_id = $detailTwo[$arrIndex]['id'];
                    $productDetail->price = $price[$items];
                    $productDetail->num = $num[$items];
                    $productDetail->save();
                    $arrIndex++;
                    $items++;
                }
            } else {
                $productDetail = new ProductDetail();
                $productDetail->product_id = $product_id;
                $productDetail->title_one_id = $option['id'];

                $productDetail->product_id = $product_id;
                $productDetail->title_two_id = 0;
                $productDetail->price = $price[$items];
                $productDetail->num = $num[$items];
                $productDetail->save();

                $items++;
            }
        }



        return redirect('backend/product');
    }

    public function runValidate($method)
    {
        switch ($method) {
            case 'store':
                $rules = [
                    'type' => 'required|string'
                ];
                (!empty($this->request['description_ch'])) && $rules['description_ch'] = 'required|string';
                (!empty($this->request['description_en'])) && $rules['description_en'] = 'required|string';
                $data = $this->request->toArray();
                break;
            case 'update':
                $rules = [
                    'id' => 'required|exists:kkdays_airport_type_codes,id',
                    'type' => 'required|string'
                ];
                (!empty($this->request['description_ch'])) && $rules['description_ch'] = 'required|string';
                (!empty($this->request['description_en'])) && $rules['description_en'] = 'required|string';
                $data = $this->request->toArray() + ['id' => $this->dataId];
                break;
            case 'destroy':
                $rules = [
                    'id' => 'required|exists:kkdays_airport_type_codes,id',
                ];
                $data = ['id' => $this->dataId];
                break;
        }

        $this->response = self::validate($data, $rules, $this->changeErrorName);

        return $this;
    }
}
