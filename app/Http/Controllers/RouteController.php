<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function toHome(Request $request)
    {
        $products = Product::paginate(9);
        return response()->view('pages.home', ['products' => $products], 200);
    }

    public function toSignIn(Request $request)
    {
        return response()->view('pages.signin', [], 200);
    }

    public function toSignUp(Request $request)
    {
        return response()->view('pages.signup', [], 200);
    }

    public function toCart(Request $request)
    {
        return response()->view('pages.cart', [], 200);
    }

    public function viewProduct(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            abort(404);
        }
        return response()->view('pages.product_overview', ['product' => $product], 200);
    }

    public function helpCenter(Request $request)
    {
        return response()->view('pages.help', [], 200);
    }
}
