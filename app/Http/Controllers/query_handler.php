<?php

namespace App\Http\Controllers;

use App\Models\ekspor;
use App\Models\impor;
use Illuminate\Http\Request;

class query_handler extends Controller
{
    public function mainDataControl(Request $request)
    {
        $validatedData = $request->validate([
            'tahun' => 'required|integer',
            'tipe' => 'required|string',
            'jenis' => 'required|string',
            'volorval' => 'required|string',
        ]);

        if ($validatedData['tipe'] == "ekspor"){
            $result = $this->eksporLineChartDataYear($validatedData['jenis'], $validatedData['tahun'], $validatedData['volorval'])->getData();
            return response()->json(['dataAngka' => $result->dataAngka, 'bulan' => $result->bulan]);

        } else if ($validatedData['tipe'] == "impor"){
            
            $result = $this->imporLineChartDataYear($validatedData['jenis'], $validatedData['tahun'], $validatedData['volorval'])->getData();
            return response()->json(['dataAngka' => $result->dataAngka, 'bulan' => $result->bulan]);

        }

    }

    private function eksporLineChartDataYear(String $jenis, Int $tahun, String $volorval)
    {
        $model = Ekspor::class;
        return $this->getLineChartDataYear($model, $jenis, $tahun, $volorval);
    }

    private function imporLineChartDataYear(String $jenis, Int $tahun, String $volorval)
    {
        $model = impor::class;
        return $this->getLineChartDataYear($model, $jenis, $tahun, $volorval);
    }

    private function getLineChartDataYear($model, String $jenis, Int $tahun, String $volorval)
    {
        if ($volorval == "Value"){

            $dataAngka = $model::where('Type', $jenis)->where('Year', $tahun)->pluck('Value');
            $bulan = $model::where('Type', $jenis)->where('Year', $tahun)->pluck('Month');
            return response()->json(['dataAngka' => $dataAngka, 'bulan' => $bulan]);

        } else if ($volorval == "Volume"){

            $dataAngka = $model::where('Type', $jenis)->where('Year', $tahun)->pluck('Volume');
            $bulan = $model::where('Type', $jenis)->where('Year', $tahun)->pluck('Month');
    
            return response()->json(['dataAngka' => $dataAngka, 'bulan' => $bulan]);

        }
    }

    public function multipleLineChartDataYear(String $tipe, Int $tahun, String $jenis, String $volorval)
    {
        // Data linechart impor dan ekspor, pilih tahun dan jenis

    }

    public function barChartDataType(Int $tahun)
    {

    }


    
}
