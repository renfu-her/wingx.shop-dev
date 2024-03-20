<?php

namespace App\Services;

use App\Services\BaseService;

use App\Models\ProductCategory;

use App\Traits\RulesTrait;

/**
 * Class OrderService
 * @package App\Services
 */
class CategoryService extends BaseService
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

    public function list()
    {
        $data = $this->request->toArray();

        $category = ProductCategory::all();

        return $category;
    }

    public function store()
    {
        $data = $this->request->toArray();



        return $this;
    }
    public function update()
    {
        $data = $this->request->toArray();



        return $this;
    }
    public function destroy()
    {
        $data = $this->request->toArray();



        return $this;
    }
}
