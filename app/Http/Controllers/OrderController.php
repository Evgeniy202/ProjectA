<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\CartProduct;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Products;
use App\Session\GetCategories;
use App\Session\GetSelected;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function orderView()
    {
        $categoriesList = new GetCategories();
        $categoriesList = $categoriesList->getCategoriesList();

        $chosenOneArray = new GetSelected();
        $chosenOneArray = $chosenOneArray->getSelected();

        $inCart = CartProduct::query()->where('user', Auth::user()->id)->get();

        $productsId = [];

        if (!empty($inCart[0]))
        {
            foreach ($inCart as $prod) {
                array_push($productsId, $prod->product);
            }
        }

        return view('makeOrder', [
            'categoriesList' => $categoriesList,
            'chosenOneArray' => $chosenOneArray,
            'inCart' => $inCart,
            'cartProductsList' => Products::query()->whereIn('id', $productsId)->get()
        ]);
    }

    public function checkOrder(OrderRequest $request)
    {
        if ((!empty($user = Auth::user()->id)) && ($request->input('generalPrice') > 0))
        {
            $review = new Order();

            $review->user = $user;
            $review->price = $request->input('generalPrice');
            $review->name = $request->input('name');
            $review->phone = $request->input('phone');
            $review->address = $request->input('address');
            if (!empty($request->input('comment')))
            {
                $review->comment = $request->input('comment');
            }
            $review->status = 'New';

            $review->save();

            $products = CartProduct::query()->where('user', $user)->get();

            foreach ($products as $product)
            {
                $review = new OrderProduct();

                $review->user = $product->user;
                $review->product = $product->product;
                $review->number = $product->number;

                $review->save();
            }

            return redirect()->route('home')->with('success', 'Success! The manager will contact you shortly.');
        }

    }
}
