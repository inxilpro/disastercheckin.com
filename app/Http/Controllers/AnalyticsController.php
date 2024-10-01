<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use App\Models\PhoneNumber;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class AnalyticsController extends Controller
{
    public function __invoke()
    {
        return view('stats', [
            'total_phone_numbers' => PhoneNumber::query()->count(),
            'stats_phone_numbers' => $this->aggregate(PhoneNumber::query()),
            'total_check_ins' => CheckIn::query()->count(),
            'stats_check_ins' => $this->aggregate(CheckIn::query()),
        ]);
    }

    private function start()
    {
        return now()->subDays(6);
    }

    private function end()
    {
        return now();
    }

    private function getDatePeriod(): Collection
    {
        return collect(
            CarbonPeriod::between(
                $this->start(),
                $this->end(),
            )->interval('1 day')
        );
    }

    private function aggregate(Builder $builder, $col = 'id'): Collection
    {
        $values = $builder
            ->toBase()
            ->selectRaw("
                date_format(created_at, '%Y-%m-%d') as date,
                count({$col}) as aggregate
            ")
            ->whereBetween('created_at', [$this->start(), $this->end()])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return $this->mapValuesToDates($values);
    }

    private function mapValuesToDates(Collection $values): Collection
    {
        $values = $values->map(fn ($value) => (object) [
            'date' => $value->date,
            'aggregate' => $value->aggregate,
        ]);

        $placeholders = $this->getDatePeriod()->map(
            fn (Carbon $date) => (object) [
                'date' => $date->format('Y-m-d'),
                'aggregate' => 0,
            ]
        );

        return $values
            ->merge($placeholders)
            ->unique('date')
            ->map(fn ($row) => (object) [
                'date' => $row->date,
                'label' => Carbon::parse($row->date)->format('M d'),
                'aggregate' => $row->aggregate,
            ])
            ->sortBy(function ($row) {
                return strtotime(((object) $row)->date);
            }, SORT_REGULAR, false)
            ->values();
    }
}
