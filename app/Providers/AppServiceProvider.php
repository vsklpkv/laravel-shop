<?php

namespace App\Providers;

use App\Http\Kernel;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Connection;
use Illuminate\Database\Events\QueryExecuted;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }
    public function boot(): void
    {
        Model::shouldBeStrict(!app()->isProduction());

        if (app()->isProduction()) {

            DB::listen(static function ($query) {
                if ($query->time > 200) {
                    logger()->channel('telegram')->debug('Long query: ' . $query->sql, $query->bindings);
                }
            });

            app(Kernel::class)->whenRequestLifecycleIsLongerThan(
                CarbonInterval::seconds(4),
                static function () {
                    logger()->channel('telegram')->debug('whenRequestLifecycleIsLongerThan: ' . request()->url());
                }
            );
        }
    }
}
