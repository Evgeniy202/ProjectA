<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Selected;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SelectedController extends Controller
{
    public function choseOne($product)
    {
        if (!empty($user = Auth::user()->id))
        {
            $review = new Selected();

            $review->user = $user;
            $review->product = $product;

            $review->save();

            return redirect()->back();
        }

        return redirect(route('login'));
    }

    public function removeChoseOne($product)
    {
        if ($user = Auth::user()->id)
        {
            Selected::query()->where('user', $user)->where('product', $product)->delete();
        }

        return redirect()->back();
    }

    public function selected()
    {
        if (!empty($user = Auth::user()->id))
        {
            $selectedIds = [];
            $selected = Selected::query()->where('user', $user)->get();
        }

        foreach ($selected as $select)
        {
            array_push($selectedIds, $select->product);
        }

        if (!empty($selectedIds[0]))
        {
            $products = Products::query()->whereIn('id', $selectedIds)->get();
        }

        if (empty($products))
        {
            $products = null;
        }

        return view('selected', [
            'categoriesList' => Categories::all(),
            'selectedProducts' => $products
        ]);
    }
}
