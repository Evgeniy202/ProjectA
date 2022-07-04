<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Http\Requests\SearchRequest;

class FindController extends Controller
{
    public function SearchProdInCat(SearchRequest $request, $categoryId)
    {
        if (session('admin') != null)
        {
            $searchVar = $request->input('search');

            $productsList = Products::query()
                ->where('category', $categoryId)
                ->where('tittle', 'LIKE', "%{$searchVar}%")
                ->orderBy('tittle')
                ->paginate(20);

            return view('admin.productsOfCategory', [
                'admin' => session('admin'),
                'accessLevel' => session('accessLevel'),
                'category' => Categories::query()->find($categoryId),
                'productsList' => $productsList
            ]);
        }
    }
}
