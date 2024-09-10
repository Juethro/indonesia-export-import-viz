<?php

namespace App\Http\Controllers;

use App\Models\ekspor;
use App\Models\impor;
use Illuminate\Http\Request;

class query_handler extends Controller
{
    public function totalDataControl(Request $request)
    {
        $validatedData = $request->validate([
            'tahun' => 'required|integer',
            'tipe' => 'required|string',
            'volorval' => 'required|string',
        ]);

        if ($validatedData['tipe'] == "ekspor"){
            $result = $this->eksporLineChartDataYear($validatedData['tahun'], $validatedData['volorval'])->getData();
            return response()->json(['dataAngka' => $result->dataAngka, 'bulan' => $result->bulan]);

        } else if ($validatedData['tipe'] == "impor"){

            $result = $this->imporLineChartDataYear($validatedData['tahun'], $validatedData['volorval'])->getData();
            return response()->json(['dataAngka' => $result->dataAngka, 'bulan' => $result->bulan]);

        }

    }

    // EKSPOR
    private function eksporLineChartDataYear( Int $tahun, String $volorval)
    {
        $model = Ekspor::class;
        return $this->getLineChartDataYear($model, $tahun, $volorval);
    }

    // IMPOR
    private function imporLineChartDataYear( Int $tahun, String $volorval)
    {
        $model = impor::class;
        return $this->getLineChartDataYear($model, $tahun, $volorval);
    }

    // getData
    private function getLineChartDataYear($model, Int $tahun, String $volorval)
    {

        if ($volorval == "Value"){
            // Untuk mengurutkan Bulan biar dimulai dari Januari
            $monthMapping = [
                'January' => 1, 'February' => 2, 'March' => 3,
                'April' => 4, 'May' => 5, 'June' => 6,
                'July' => 7, 'August' => 8, 'September' => 9,
                'October' => 10, 'November' => 11, 'December' => 12
            ];

            // SQL Query Total Value
            $dataAngka = $model::where('Year', $tahun)
                ->groupBy('Month')
                ->selectRaw('Month, CAST(SUM(Value) AS UNSIGNED) as total')
                ->get()
                ->sortBy(function($item) use ($monthMapping) {
                    return $monthMapping[$item->Month];  // Mengurutkan berdasarkan mapping bulan
                })
                ->pluck('total');

            $bulan = $model::where('Year', $tahun)
                ->selectRaw('Month')  // Pastikan hanya memilih kolom yang ada dalam group
                ->groupBy('Month')    // Group by Month
                ->orderByRaw("FIELD(Month, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December')")
                ->pluck('Month');

            return response()->json(['dataAngka' => $dataAngka, 'bulan' => $bulan]);

        } else if ($volorval == "Volume"){
            // Untuk mengurutkan Bulan biar dimulai dari Januari
            $monthMapping = [
                'January' => 1, 'February' => 2, 'March' => 3,
                'April' => 4, 'May' => 5, 'June' => 6,
                'July' => 7, 'August' => 8, 'September' => 9,
                'October' => 10, 'November' => 11, 'December' => 12
            ];

            // SQL Query Volume
            $dataAngka = $model::where('Year', $tahun)
                ->groupBy('Month')
                ->selectRaw('Month, CAST(SUM(Volume) AS UNSIGNED) as total')
                ->get()
                ->sortBy(function($item) use ($monthMapping) {
                    return $monthMapping[$item->Month];  // Mengurutkan berdasarkan mapping bulan
                })
                ->pluck('total');

            $bulan = $model::where('Year', $tahun)
                ->selectRaw('Month')  // Pastikan hanya memilih kolom yang ada dalam group
                ->groupBy('Month')    // Group by Month
                ->orderByRaw("FIELD(Month, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December')")
                ->pluck('Month');

            return response()->json(['dataAngka' => $dataAngka, 'bulan' => $bulan]);
        }
    }


    // Selamat Berjuang!!


    // Fungsi Utama
    public function comparisonDataControl(Request $request)
    {
        $validatedData = $request->validate([
            'tahun_2' => 'required|integer',
            'tipe_2' => 'required|string',
            'volorval_2' => 'required|string',
        ]);

        if ($validatedData['tipe_2'] == "ekspor") {
            $result = $this->eksportComparisonLineChartDataYear($validatedData['tahun_2'], $validatedData['volorval_2']);
            return response()->json($result);
        } else if ($validatedData['tipe_2'] == "impor") {
            $result = $this->imporComparisonLineChartDataYear($validatedData['tahun_2'], $validatedData['volorval_2']);
            return response()->json($result);
        }
    }

// Fungsi Ekspor
    private function eksportComparisonLineChartDataYear(Int $tahun, String $volorval)
    {
        $model = Ekspor::class;
        return $this->getComparisonLineChartDataYear($model, $tahun, $volorval);
    }

// Fungsi Impor
    private function imporComparisonLineChartDataYear(Int $tahun, String $volorval)
    {
        $model = impor::class;
        return $this->getComparisonLineChartDataYear($model, $tahun, $volorval);
    }

// getData
    private function getComparisonLineChartDataYear($model, Int $tahun, String $volorval)
    {
        $monthMapping = [
            'January' => 1, 'February' => 2, 'March' => 3,
            'April' => 4, 'May' => 5, 'June' => 6,
            'July' => 7, 'August' => 8, 'September' => 9,
            'October' => 10, 'November' => 11, 'December' => 12
        ];

        // Ambil kolom yang sesuai (Value atau Volume)
        $column = ($volorval == "Value") ? 'Value' : 'Volume';

        $dataOilGas = $model::where('Year', $tahun)
            ->where('Type', 'Oil & Gas')
            ->groupBy('Month')
            ->selectRaw("Month, CAST(SUM($column) AS UNSIGNED) as total")
            ->get()
            ->sortBy(function ($item) use ($monthMapping) {
                return $monthMapping[$item->Month];
            })
            ->pluck('total');

        $dataNonOilGas = $model::where('Year', $tahun)
            ->where('Type', 'Non Oil &Gas')
            ->groupBy('Month')
            ->selectRaw("Month, CAST(SUM($column) AS UNSIGNED) as total")
            ->get()
            ->sortBy(function ($item) use ($monthMapping) {
                return $monthMapping[$item->Month];
            })
            ->pluck('total');

        $bulan = $model::where('Year', $tahun)
            ->selectRaw('Month')
            ->groupBy('Month')
            ->orderByRaw("FIELD(Month, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December')")
            ->pluck('Month');

        // Mengembalikan array data yang bisa diubah menjadi JSON di luar
        return ['dataAngkaOilGas' => $dataOilGas, 'dataAngkaNonOilGas' => $dataNonOilGas, 'bulan' => $bulan];
    }


}
