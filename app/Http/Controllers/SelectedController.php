<?php

namespace App\Http\Controllers;

use App\Models\Selected;
use Illuminate\Http\Request;

class SelectedController extends Controller
{
    public function choseOne($user, $product)
    {
        $review = new Selected();

        $review->user = $user;
        $review->product = $product;

        $review->save();

        return redirect()->back();
    }
}
