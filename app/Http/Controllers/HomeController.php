<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function __invoke()
    {
        return response((string) view('home'))
            ->setMaxAge(300)
            ->setSharedMaxAge(180)
            ->setExpires(now()->addMinutes(3));
    }
}
