<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\CharOfCat;
use App\Models\Products;
use App\Models\ValueOfChar;
use App\Filters\filterOfCategory;
use App\Http\Requests\FilterRequest;
//use App\Support\Collection;
use Illuminate\Support\Collection;

class CategoriesController extends Controller
{
    public function prodOfCatView($categoryId, FilterRequest $request)
    {
        if (!empty($request->all())){
            $answer = new filterOfCategory();
            $context = $answer->filter($categoryId, $request);
            $products = $context['products'];
        }

        if ($request->filled('sort'))
        {
            $sort = $request->sort;

            if ($sort == 'rand')
            {
                return redirect(route('prodOfCatView', $categoryId));
            }
            else {
                if ($sort == 'exp') {
                    $sortList = [
                        ['val' => 'exp', 'tittle' => 'Expensive at first'],
                        ['val' => 'ch', 'tittle' => 'Cheap at firs'],
                        ['val' => 'rand', 'tittle' => 'Randomly'],
                    ];
                    $products = $products
                        ->orderBy('price', 'desc');
                } else if ($sort == 'ch') {
                    $sortList = [
                        ['val' => 'ch', 'tittle' => 'Cheap at firs'],
                        ['val' => 'rand', 'tittle' => 'Randomly'],
                        ['val' => 'exp', 'tittle' => 'Expensive at first'],
                    ];
                    $products = $products
                        ->orderBy('price', 'asc');
                }
            }
        }
        elseif (!$request->filled('sort'))
        {
            if (!empty($products))
            {
                $products = $products->inRandomOrder();
            }
            else
            {
                $products = Products::query()
                    ->where('category', $categoryId)->inRandomOrder();
            }

            $sortList = [
                ['val' => 'rand', 'tittle' => 'Randomly'],
                ['val' => 'exp', 'tittle' => 'Expensive at first'],
                ['val' => 'ch', 'tittle' => 'Cheap at firs'],
            ];

            $context['chars'] = CharOfCat::query()
                ->where('category', $categoryId)
                ->orderBy('numberInFilter', 'asc')
                ->get();

            $context['values'] = ValueOfChar::query()
                ->orderBy('numberInFilter')
                ->get();
        }
        $items = $context['productsFil'];
        $perPage = 3;
        $page = null;
        $options = [];

        $page = $page ?: (\Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof \Illuminate\Support\Collection ? $items : \Illuminate\Support\Collection::make($items);
        $productsFil = new \Illuminate\Pagination\LengthAwarePaginator(array_values($items->forPage($page, $perPage)->toArray()), $items->count(), $perPage, $page, $options);

        if (isset($products)) {
            return view('prodOfCategory', [
                'sortList' => $sortList,
                'category' => Categories::query()
                    ->find($categoryId),
                'categoriesList' => Categories::all(),
                'productsList' => $products->paginate(9)->withPath('?'.$request->getQueryString()),
                'charsList' => $context['chars'],
                'valuesList' => $context['values'],
                'productsFil' => $productsFil ?? null
            ]);
        }
    }

    public function sortProducts($categoryId, $sort)
    {
        if ($sort == 'rand')
        {
            return redirect(route('prodOfCatView', $categoryId));
        }
        else {
            if ($sort == 'exp') {
                $sortList = [
                    ['val' => 'exp', 'tittle' => 'Expensive at first'],
                    ['val' => 'ch', 'tittle' => 'Cheap at firs'],
                    ['val' => 'rand', 'tittle' => 'Randomly'],
                ];
                $products = Products::query()
                    ->where('category', $categoryId)
                    ->orderBy('price', 'desc')
                    ->paginate(9);
            } else if ($sort == 'ch') {
                $sortList = [
                    ['val' => 'ch', 'tittle' => 'Cheap at firs'],
                    ['val' => 'rand', 'tittle' => 'Randomly'],
                    ['val' => 'exp', 'tittle' => 'Expensive at first'],
                ];
                $products = Products::query()
                    ->where('category', $categoryId)
                    ->orderBy('price', 'asc')
                    ->paginate(9);
            }

            if (isset($products)) {
                return view('prodOfCategory', [
                    'sortList' => $sortList,
                    'category' => Categories::query()
                        ->find($categoryId),
                    'categoriesList' => Categories::all(),
                    'productsList' => $products,
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
    }
}
