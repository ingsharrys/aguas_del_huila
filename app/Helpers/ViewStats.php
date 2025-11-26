<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class ViewStats
{
    public static function stats($route)
    {
        $today = now()->toDateString();
        $month = now()->month;

        return DB::table('views')
            ->selectRaw('
                COUNT(*) as total,
                SUM(CASE WHEN MONTH(date) = ? THEN 1 ELSE 0 END) as monthly,
                SUM(CASE WHEN date = ? THEN 1 ELSE 0 END) as daily
            ', [$month, $today])
            ->where('route', $route)
            ->first();
    }
}
