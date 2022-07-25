<?php

namespace App\Session;

use Illuminate\Support\Facades\Auth;
use App\Models\Selected;

class GetSelected
{
    public function getSelected()
    {
        if (empty(session('selected')))
        {
            if (!empty(Auth::user()->id))
            {
                $chosenOne = Selected::query()->where('user', Auth::user()->id)->get();
            }
            $chosenOneArray = [];

            if ((!empty($chosenOne)) && ($chosenOne != null))
            {
                foreach ($chosenOne as $chosenProduct) {
                    array_push($chosenOneArray, $chosenProduct->product);
                }
            }

            session(['selected' => $chosenOneArray]);
        }
        elseif (!empty(session('selected')))
        {
            $chosenOneArray = session('selected');
        }

        return $chosenOneArray;
    }
}
