<?php

namespace App\Http\Controllers;

use App\Models\PhoneNumber;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\Cache;

class PhoneNumberController extends Controller
{
    public function __invoke(string $phone_number)
    {
        $e164 = e164($phone_number);
        $cached = true;

        $phone_number = Cache::remember("phone-number-view:{$e164}", now()->addHour(), function () use ($e164, &$cached) {
            $cached = false;

            return PhoneNumber::findByValueOrCreate($e164)
                ->loadMissing(['check_ins' => fn (Builder $query) => $query->latest()->limit(10)]);
        });

        $view = view('phone-number', ['phone_number' => $phone_number]);

        return response((string) $view, headers: ['X-Cache-Hit' => $cached])
            ->setMaxAge(120)
            ->setSharedMaxAge(30)
            ->setExpires(now()->addMinutes(2));
    }
}
