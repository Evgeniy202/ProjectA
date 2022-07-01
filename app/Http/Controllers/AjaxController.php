<?php

namespace App\Http\Controllers;

use App\Models\ValueOfChar;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function findCharValue($productId, $charId)
    {
        $valueOfThisChar = ValueOfChar::where('char', $charId)->get();
        return response()->json($valueOfThisChar);
    }
}
