<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart($productId)
    {
        if ($user = Auth::user()->id)
        {
            if (empty(CartProduct::query()->where('product', $productId)->get()[0]))
            {
                $review = new CartProduct();

                $review->user = $user;
                $review->product = $productId;
                $review->number = 1;

                $review->save();
            }

            return redirect()->back();
        }
        else
        {
            return redirect(route('login'));
        }
    }

    public function cartView()
    {
        $inCart = CartProduct::query()->where('user', Auth::user()->id)->get();

        $productsId = [];

        if (!empty($inCart[0]))
        {
            foreach ($inCart as $prod) {
                array_push($productsId, $prod->product);
            }
        }

        return view('cart', [
            'categoriesList' => Categories::all(),
            'inCart' => $inCart,
            'cartProductsList' => Products::query()->whereIn('id', $productsId)->get()
        ]);
    }

    public function changeNumberProduct($cartProductId, Request $request)
    {
        $review = CartProduct::query()->find($cartProductId);

        if (!empty($review))
        {
            $review->number = $request->input('qty');

            $review->save();
        }

        return redirect()->back();
    }

    public function removeProductFromCart($cartProductId)
    {
        CartProduct::query()->where('user', Auth::user()->id)->where('id', $cartProductId)->delete();

        return redirect()->back();
    }

    public function cleanCart()
    {
        CartProduct::query()->where('user', Auth::user()->id)->delete();

        return redirect()->back();
    }
}
