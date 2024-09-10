<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function getScoreboardData(Request $request)
    {
        $year = $request->input('year');
        $type = $request->input('type');  // 'Value' or 'Volume'
        $tipe = $request->input('tipe');  // 'ekspor' or 'impor'

        // Validasi input
        if (!in_array($type, ['Value', 'Volume']) || !in_array($tipe, ['ekspor', 'impor'])) {
            return response()->json(['error' => 'Invalid input'], 400);
        }

        // Pilih tabel berdasarkan tipe
        $table = ($tipe === 'ekspor') ? 'eksport' : 'import';

        // Query database untuk mendapatkan total
        $total = DB::table($table)
            ->where('Year', $year)
            ->sum($type);

        // Jika total tidak ditemukan, return error
        if (is_null($total)) {
            return response()->json(['error' => 'Data not found'], 404);
        }

        return response()->json(['total' => round($total, 2)]);
    }
}
