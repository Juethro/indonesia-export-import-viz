<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function getScoreboardData(Request $request)
    {
        // Implementasi logika untuk mengambil data scoreboard
        // Contoh sederhana:
        return response()->json([
            'total' => rand(1000, 10000)
        ]);
    }
}