<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserStatisticsController extends Controller
{
    public function index()
    {
        $daily = DB::table('user_statistics')
            ->whereDate('date', Carbon::today())
            ->sum('user_count');

        $weekly = DB::table('user_statistics')
            ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum('user_count');

        $monthly = DB::table('user_statistics')
            ->whereMonth('date', Carbon::now()->month)
            ->sum('user_count');

        return response()->json([
            'daily' => $daily,
            'weekly' => $weekly,
            'monthly' => $monthly,
        ]);
    }
}