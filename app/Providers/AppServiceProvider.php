<?php

namespace App\Providers;

use App\Models\PhoneNumber;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Model::unguard();
        Model::shouldBeStrict();
    }

    public function boot(): void
    {
        $db_file = database_path('disaster.sqlite');

        if ( !file_exists($db_file) ) {
            file_put_contents($db_file, '');
        }

        dump(file_exists($db_file));

        config([
            'app.debug' => true,
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => 'database/disaster.sqlite'
        ]);

        Blade::stringable(PhoneNumber::class, fn (PhoneNumber $phone_number) => $phone_number->value->formatNational());

        require_once __DIR__.'/../helpers.php';
    }
}
