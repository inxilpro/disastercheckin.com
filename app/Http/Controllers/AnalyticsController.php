<?php

namespace App\Http\Controllers;

use App\Events\SubscribedToPhoneNumber;
use App\Http\Requests\SubscribeRequest;

class AnalyticsController extends Controller
{
    public function __invoke()
    {
        return view('stats');
    }
}
