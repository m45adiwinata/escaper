<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriber;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
        ]);
        $data = new Subscriber;
        $data->email = $request->email;
        $data->save();

        return back();
    }
}
