<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadisticasController extends Controller
{
    //
    public function index()
    {
        /*
        // 1. Total por día (últimos 15 días)
        $dailyViews = DB::table('views')
                        ->selectRaw('DATE(date) as day, COUNT(*) as total')
                        ->whereBetween('date', [
                            now()->subDays(14)->startOfDay(),
                            now()->endOfDay()
                        ])
                        ->groupBy('day')
                        ->orderBy('day')
                        ->get();

        // 2. Total por mes (últimos 12 meses)
        $monthlyViews = DB::table('views')
                            ->selectRaw('YEAR(date) as year, MONTH(date) as month, COUNT(*) as total')
                            ->whereBetween('date', [
                                now()->subMonths(11)->startOfMonth(),
                                now()->endOfMonth()
                            ])
                            ->groupBy('year', 'month')
                            ->orderBy('year')
                            ->orderBy('month')
                            ->get()
                            ->map(function ($item) {
                                $item->month_label = $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT);
                                return $item;
                            });

        // 3. Rutas más visitadas
        $topRoutes = DB::table('views')
                        ->select('route', DB::raw('COUNT(*) as total'))
                        ->whereBetween('date', [
                            now()->subMonths(3), // 🔥 limita análisis
                            now()
                        ])
                        ->groupBy('route')
                        ->orderByDesc('total')
                        ->limit(10)
                        ->get();

        // 4. Total de visitas en general
        $globalCount = DB::table('views')->count();


        return view('dashboard', compact(
            'dailyViews', 'monthlyViews', 'topRoutes', 'globalCount'
        ));
        */
        return view('dashboard');
    }
}
