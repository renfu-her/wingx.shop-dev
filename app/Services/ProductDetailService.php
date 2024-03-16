<?php

namespace App\Services;

use App\Services\BaseService;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductMix;

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

        return view('backend.productDetail.index', compact('product'));
    }

    public function store()
    {
        $data = $this->request->toArray();

        dd($data);
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
