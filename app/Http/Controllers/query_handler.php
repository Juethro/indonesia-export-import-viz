<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class query_handler extends Controller
{
    public function chart_1_get(String $tahun, String $jenis)
    {
        $jenisEkspor = $jenis;
        $tahunData = $tahun;
        $dataAngka = [];
        $bulan = [];
        // Logika untuk mengisi $dataAngka dan $bulan berdasarkan tahun yang diterima
        // Contoh:
        // $dataAngka = [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, 1100, 1200];
        // $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        // dd($dataAngka);
        dd(['dataAngka' => $dataAngka, 'jenisEkspor' => $jenisEkspor]);
        return response()->json(['dataAngka' => $dataAngka, 'bulan' => $bulan]);
    }

    public function chart_2_get($tahun)
    {
        $dataAngka = [];
        $bulan = [];
        // Logika untuk mengisi $dataAngka dan $bulan berdasarkan tahun yang diterima
        // Contoh:
        // $dataAngka = [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, 1100, 1200];
        // $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
        return response()->json(['dataAngka' => $dataAngka, 'bulan' => $bulan]);
    }

    public function chart_3_get($tahun)
    {
        $dataAngka = [];
        $bulan = [];
        // Logika untuk mengisi $dataAngka dan $bulan berdasarkan tahun yang diterima
        // Contoh:
        // $dataAngka = [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, 1100, 1200];
        // $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
        return response()->json(['dataAngka' => $dataAngka, 'bulan' => $bulan]);
    }

    public function chart_4_get($tahun)
    {
        $dataAngka = [];
        $bulan = [];
        // Logika untuk mengisi $dataAngka dan $bulan berdasarkan tahun yang diterima
        // Contoh:
        // $dataAngka = [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, 1100, 1200];
        // $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
        return response()->json(['dataAngka' => $dataAngka, 'bulan' => $bulan]);
    }

    
}
