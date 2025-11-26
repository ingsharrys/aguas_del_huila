<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadisticasController extends Controller
{
    //
    public function index()
    {
        // 1. Total por día (últimos 15 días)
        $dailyViews = DB::table('views')
            ->select(DB::raw('date, COUNT(*) as total'))
            ->whereBetween('date', [now()->subDays(14), now()])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // 2. Total por mes (últimos 12 meses)
        $monthlyViews = DB::table('views')
            ->select(DB::raw('DATE_FORMAT(date, "%Y-%m") as month, COUNT(*) as total'))
            ->groupBy('month')
            ->orderBy('month')
            ->take(12)
            ->get();

        // 3. Rutas más visitadas
        $topRoutes = DB::table('views')
            ->select('route', DB::raw('COUNT(*) as total'))
            ->groupBy('route')
            ->orderByDesc('total')
            ->take(10)
            ->get();

        // 4. Total de visitas en general
        $globalCount = DB::table('views')->count();

        return view('dashboard', compact(
            'dailyViews', 'monthlyViews', 'topRoutes', 'globalCount'
        ));
    }
}
