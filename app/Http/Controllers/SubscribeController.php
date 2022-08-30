<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SubscribeRequest;
use App\Models\Subscribe;

class SubscribeController extends Controller
{
    
    public function subscribe(SubscribeRequest $request) {
       
        $newSub = new Subscribe;
        $newSub->email = $request->email;

        $newSub->save();

        return redirect('/')->with('message', 'Thank you for subscribe');

    }
}
