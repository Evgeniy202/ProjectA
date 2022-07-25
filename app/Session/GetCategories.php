<?php

namespace App\Session;

use App\Models\Categories;

class GetCategories
{
    public function getCategoriesList()
    {
        if (empty(session('categoriesList')))
        {
            session(['categoriesList' => Categories::all()]);
            $categoriesList = Categories::all();
        }
        elseif (!empty(session('categoriesList')))
        {
            $categoriesList = Categories::all();
        }

        return $categoriesList;
    }
}
