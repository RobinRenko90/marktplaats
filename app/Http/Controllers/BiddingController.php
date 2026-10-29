<?php

namespace App\Http\Controllers;

use App\Http\Requests\BiddingRequest;
use App\Models\Advertisement;
use App\Models\Bidding;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


use Auth;

class BiddingController extends Controller
{
    public function store(BiddingRequest $request , Advertisement $advertisement) {
        
        $bidding = Bidding::firstOrCreate([
            'user_id'   => Auth::user()->id,
            'value'     => $request['value'],
        ]);

        $syncBidding = $advertisement->biddings()->syncWithoutDetaching($bidding->id);

        return Redirect::route('advertisement.show', $advertisement);
    }
}
