<?php

namespace App\Http\Controllers;

use App\Events\PhoneNumberQueried;
use App\Http\Requests\SearchRequest;
use Illuminate\Contracts\Database\Query\Builder;

class SearchController extends Controller
{
    public function __invoke(SearchRequest $request)
    {
        $phone_number = PhoneNumberQueried::commit(
            phone_number: $request->validated('phone_number')
        );

        $phone_number->loadMissing(['check_ins' => fn (Builder $query) => $query->latest()->limit(10)]);

        return view('search', ['phone_number' => $phone_number]);
    }
}
