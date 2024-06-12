<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Member;

use App\Services\CartService;

class ProfileController extends Controller
{

    // 會員 Profile
    public function index(Request $request)
    {

        $member_id = Auth::guard('member')->user()->id;
        if (!$member_id) {
            redirect('/')->with(['message' => '請先登入會員']);
        }

        $member = Member::find($member_id);

        $req = $request->all();

        $products = $this->getProduct();
        $product_categories = $this->getProductCategory();

        $total = 0;
        $tax = 0;
        $cart = (new CartService())->getCartAll();
        foreach ($cart as $key => $value) {
            $total += $value['prod_price'] * $value['qty'];
            $tax +=  ($value['prod_price'] * $value['qty']) * 0.05;
        }

        $ships = $this->getShipAll();

        $cart_count = (new CartService())->getCart();
        $cart_count = json_decode($cart_count->getContent(), true);


        return view(
            'frontend.profile',
            compact(
                'member',
                'products',
                'product_categories',
                'cart',
                'cart_count',
                'total',
                'tax',
                'ships',
            )
        );
    }

    // 會員 Update
    public function update(Request $request)
    {
        $req = $request->all();

        $member_id = Auth::guard('member')->user()->id;
        if (!$member_id) {
            redirect('/')->with(['message' => '請先登入會員']);
        }

        $member = Member::find($member_id);

        $member->update([
            'name' => $req['name'],
            'email' => $req['email'],
            'mobile' => $req['mobile'],
            'county' => $req['county'],
            'district' => $req['district'],
            'zipcode' => $req['zipcode'],
            'address' => $req['address'],
        ]);

        if (trim($req['password']) != '') {
            $member->update([
                'password' => Hash::make($req['password']),
            ]);
        }

        return redirect('/profile')->with(['message' => '會員資料更新成功']);
    }
}
