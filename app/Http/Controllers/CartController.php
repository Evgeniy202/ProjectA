<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
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
}
