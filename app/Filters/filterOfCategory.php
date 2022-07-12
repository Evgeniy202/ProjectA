<?php

namespace App\Filters;

use App\Models\CharOfCat;
use App\Models\CharOfProd;
use App\Models\Products;
use App\Models\ValueOfChar;

class filterOfCategory
{
    public function filter($categoryId, $request)
    {
        $products = Products::query()
            ->where('category', $categoryId);
        $chars = CharOfCat::query()
            ->where('category', $categoryId)
            ->orderBy('numberInFilter', 'asc')
            ->get();
        $values = ValueOfChar::query()
            ->orderBy('numberInFilter')
            ->get();
        $charsOfProdAll = CharOfProd::all();

        $charsOfProd = [];
        foreach ($products->get() as $prod)
        {
            array_push($charsOfProd, $charsOfProdAll->where('product', $prod->id));
        }

        if (($request->filled('min')) && ($request->min > 0))
        {
            $products = $products->where('price', '>=', $request->min);
        }
        if (($request->filled('max')) && ($request->max > 0) && ($request->max > $request->min))
        {
            $products = $products->where('price', '<=', $request->max);
        }

        $filt = [];

        foreach ($request->all() as $object)
        {
            if (str_contains($object, '-'))
            {
                $object = explode('-', $object);

                foreach ($charsOfProd as $charOfProd)
                {
                    foreach ($charOfProd as $fil)
                    {
                        if (($object[0] == $fil->char) && ($object[1] == $fil->value))
                        {
                            array_push($filt, $fil);
                        }
                    }
                }

            }
        }
        $productsFil = collect();
        foreach ($filt as $res)
        {
            foreach ($products->get() as $product)
            {
                if ($res->product == $product->id)
                {
                    $productsFil->push($product);
                }
            }
        }

        return [
            'products' => $products,
            'chars' => $chars,
            'values' => $values,
            'productsFil' => $productsFil
        ];
    }
}
