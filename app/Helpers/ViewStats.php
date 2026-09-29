<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ViewStats
{
    public static function stats($route)
    {
        return Cache::remember(
            'view_stats_' . md5($route),
            now()->addMinutes(10),

            function () use ($route) {

                $today = now()->toDateString();

                $startMonth = now()->startOfMonth()->toDateString();
                $endMonth = now()->endOfMonth()->toDateString();

                return (object) [

                    'total' => DB::table('views')
                        ->where('route', $route)
                        ->count(),

                    'monthly' => DB::table('views')
                        ->where('route', $route)
                        ->whereBetween('date', [$startMonth, $endMonth])
                        ->count(),

                    'daily' => DB::table('views')
                        ->where('route', $route)
                        ->where('date', $today)
                        ->count(),
                ];
            }
        );
    }
}
