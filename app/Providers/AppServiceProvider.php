<?php

namespace App\Providers;

use App\Models\PhoneNumber;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

use function Pest\Laravel\artisan;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Model::unguard();
        Model::shouldBeStrict();
    }

    public function boot(): void
    {
        Blade::stringable(PhoneNumber::class, fn (PhoneNumber $phone_number) => $phone_number->value->formatNational());

        require_once __DIR__.'/../helpers.php';
    }
}
