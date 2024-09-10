<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ScoreboardController extends Controller
{
    public function getData(Request $request)
    {
        $year = $request->input('year');
        $type = $request->input('type');
        $tipe = $request->input('tipe');

        // Ensure year is between 2019 and 2023
        $year = max(2019, min(2023, intval($year)));

        // Create a unique cache key
        $cacheKey = "scoreboard_{$year}_{$type}_{$tipe}";

        // Try to get data from cache first
        $total = Cache::remember($cacheKey, 3600, function () use ($year, $type, $tipe) {
            // Adjust this query based on your actual database structure
            if ($type === 'Value') {
                return DB::table('your_table')
                    ->where('year', $year)
                    ->where('type', $tipe)
                    ->sum('value_column');
            } else {
                return DB::table('your_table')
                    ->where('year', $year)
                    ->where('type', $tipe)
                    ->sum('volume_column');
            }
        });

        // Ensure the total is always a number
        $total = is_numeric($total) ? $total : 0;

        return response()->json(['total' => $total]);
    }
}