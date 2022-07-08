<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\CharOfCat;
use App\Models\Products;
use App\Http\Requests\SearchRequest;
use App\Models\ValueOfChar;

class FindController extends Controller
{
    public function SearchProdInCatAdm(SearchRequest $request, $categoryId)
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

    public function SearchProdInCat(SearchRequest $request, $categoryId)
    {
        $searchVar = $request->input('search');

        $productsList = Products::query()
            ->where('category', $categoryId)
            ->where('tittle', 'LIKE', "%{$searchVar}%")
            ->orderBy('tittle')
            ->paginate(9);

        return view('prodOfCategory', [
            'category' => Categories::query()
                ->find($categoryId),
            'categoriesList' => Categories::all(),
            'productsList' => $productsList,
            'charsList' => CharOfCat::query()
                ->where('category', $categoryId)
                ->orderBy('numberInFilter', 'asc')
                ->get(),
            'valuesList' => ValueOfChar::query()
                ->orderBy('numberInFilter', 'asc')
                ->get()
        ]);
    }
}
