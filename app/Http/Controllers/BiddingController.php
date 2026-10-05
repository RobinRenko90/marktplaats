<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Bidding;
use Illuminate\Http\Request;

use Auth;

class BiddingController extends Controller
{
    public function store(Request $request , Advertisement $advertisement) {
        
        $bidding = Bidding::firstOrCreate([
            'user_id'   => Auth::user()->id,
            'value'     => $request['value'],
        ]);

        $syncBidding = $advertisement->biddings()->syncWithoutDetaching($bidding->id);

        return redirect()->to( Route('advertisement.show', $advertisement) );
    }
}
