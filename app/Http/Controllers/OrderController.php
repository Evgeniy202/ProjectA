<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use App\Models\Products;
use App\Session\GetCategories;
use App\Session\GetSelected;
use Illuminate\Http\Request;
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
}
